<?php

namespace App\Http\Controllers\API\V1;

use App\Helpers\V1\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\TemporaryPasswordMail;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validated = $request->validate([
            "email" => "required|email",
            "password" => "required",
        ]);

        $licence = env('LICENCE_KEY');

        if ($this->decryptString($licence)) {
            if (Auth::attempt($validated)) {
                $user = Auth::user();
                
                // Create a token directly using PersonalAccessToken
                $tokenString = Str::random(40);
                $token = new PersonalAccessToken();
                $token->tokenable_id = $user->id;
                $token->tokenable_type = get_class($user);
                $token->name = 'basic-token';
                $token->token = hash('sha256', $tokenString);
                $token->save();
                
                $accessToken = $tokenString;
                
                return ApiResponse::success([
                    'accessToken' => $accessToken,
                    'user' => new UserResource($user),
                ], 'Login successful', Response::HTTP_OK);
            }
    
            return ApiResponse::error('Email or password is incorrect');
        } else {
            return ApiResponse::error('Data type not compactible');
        }
    }

    public function logout(Request $request)
    {
        $user = Auth::user();

        if ($user) {
            // Delete all tokens for the user
            PersonalAccessToken::where('tokenable_id', $user->id)
                ->where('tokenable_type', get_class($user))
                ->delete();
                
            return ApiResponse::success([], 'Logout successful', Response::HTTP_OK);
        }

        return ApiResponse::error('User not authenticated', Response::HTTP_UNAUTHORIZED);
    }

    public function password_change(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required|string|min:8',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($validated['current_password'], $user->password)) {
            return ApiResponse::error('Current password is incorrect', Response::HTTP_UNAUTHORIZED);
        }

        User::where('id', $user->id)->update([
            'password' => Hash::make($validated['new_password'])
        ]);

        return ApiResponse::success(null, 'Password changed successfully', Response::HTTP_OK);
    }

    public function reset_password(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|string|email',
        ]);

        $response = Password::sendResetLink($validated);

        return $response === Password::RESET_LINK_SENT
            ? ApiResponse::success(null, 'Password reset link sent to your email', Response::HTTP_OK)
            : ApiResponse::error('Failed to send password reset link', Response::HTTP_BAD_REQUEST);
    }

    public function handle_reset(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|confirmed|min:8',
            'token' => 'required|string',
        ]);

        $response = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                User::where('id', $user->id)->update([
                    'password' => Hash::make($password)
                ]);
            }
        );

        return $response === Password::PASSWORD_RESET
            ? ApiResponse::success(true, 'Password has been reset successfully', Response::HTTP_OK)
            : ApiResponse::error('Failed to reset password', Response::HTTP_BAD_REQUEST);
    }

    public function send_temporary_password(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|string|email|exists:users,email',
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (!$user) {
            return ApiResponse::error('User not found', Response::HTTP_NOT_FOUND);
        }
        
        $temporaryPassword = Str::random(10);

        User::where('id', $user->id)->update([
            'password' => Hash::make($temporaryPassword)
        ]);

        try {
            Mail::to($user->email)->send(new TemporaryPasswordMail($temporaryPassword));
        } catch (\Exception $e) {
            return ApiResponse::error('Failed to send temporary password email', Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return ApiResponse::success(null, 'Temporary password sent to your email', Response::HTTP_OK);
    }
}
