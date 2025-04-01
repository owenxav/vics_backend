<?php

namespace Database\Seeders;

use App\Helpers\V1\Roles;
use App\Helpers\V1\States;
use App\Models\Company;
use App\Models\Lga;
use App\Models\PlateNumber;
use App\Models\PlateNumberOrder;
use App\Models\State;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */

    public function run(): void
    {

        $fct_state = [
            'id' => STATES::getStateId(STATES::FCT, STATES::STATES, STATES::STATE_IDS),
            'name' => STATES::FCT,
        ];

        $kaduna_state = [
            'id' => STATES::getStateId(STATES::KADUNA, STATES::STATES, STATES::STATE_IDS),
            'name' => STATES::KADUNA,
        ];

        $benue_state = [
            'id' => STATES::getStateId(STATES::BENUE, STATES::STATES, STATES::STATE_IDS),
            'name' => STATES::BENUE,
        ];

        $states = [];

        foreach (States::STATES as $index => $stateName) {
            $states[] = [
                'id' => STATES::STATE_IDS[$index],
                'name' => $stateName,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        State::insert($states);

        Lga::create([
            'state_id' => $fct_state["id"],
            'name' => "Abaji",
        ]);

        Lga::create([
            'state_id' => $fct_state["id"],
            'name' => "Abuja Municipal Area Council",
        ]);

        Lga::create([
            'state_id' => $fct_state["id"],
            'name' => "Bwari",
        ]);

        Lga::create([
            'state_id' => $fct_state["id"],
            'name' => "Gwagwalada",
        ]);

        Lga::create([
            'state_id' => $fct_state["id"],
            'name' => "Kuje",
        ]);

        Lga::create([
            'state_id' => $fct_state["id"],
            'name' => "Kwali",
        ]);

        Lga::create([
            'state_id' => $kaduna_state["id"],
            'name' => "Kaduna South",
        ]);

        Lga::create([
            'state_id' => $kaduna_state["id"],
            'name' => "Kaduna North",
        ]);

        Lga::create([
            'state_id' => $kaduna_state["id"],
            'name' => "Chikun",
        ]);

        Lga::create([
            'state_id' => $kaduna_state["id"],
            'name' => "Igabi",
        ]);

        Lga::create([
            'state_id' => $benue_state["id"],
            'name' => "Makurdi",
        ]);

        Lga::create([
            'state_id' => $benue_state["id"],
            'name' => "Gboko",
        ]);

        Lga::create([
            'state_id' => $benue_state["id"],
            'name' => "Kwande",
        ]);

        Lga::create([
            'state_id' => $benue_state["id"],
            'name' => "Vandeikya",
        ]);

        $company = Company::create([
            'id' => "01jngg67rw5mdzrwg17cb5a994",
            'state_id' => $fct_state["id"],
            'name' => "Penetralia Hub",
            'licence' => env('LICENCE_KEY'),
            'email' => "contactus@penetraliahub.com",
            'phone' => "+2347080631817",
            'address' => "Plot B06 Cadastral Zone, Mabushi, F.C.T., Abuja"
        ]);

        $super_user = User::create([
            'company_id' => $company['id'],
            'state_id' => $kaduna_state["id"],
            'firstname' => "Super",
            'lastname' => "User",
            'othername' => "Test",
            'role' => Roles::SUPER_ADMIN_USER,
            'email' => "super-admin@example.com",
            'password' => Hash::make(env('SUPER_ADMIN_PASSWORD')),
            'gender' => "male",
            'phone' => "+2327765667",
            'address' => "00 Test Address at Test City, State and Country",
            'registeration_type' => "autogenerated"
        ]);

        $admin_user = User::create([
            'company_id' => $company['id'],
            'state_id' => $fct_state["id"],
            'firstname' => "Admin",
            'lastname' => "User",
            'othername' => "Test",
            'role' => Roles::ADMIN_USER,
            'email' => "admin@example.com",
            'password' => Hash::make(env('ADMIN_PASSWORD')),
            'gender' => "male",
            'phone' => "+23245345667",
            'address' => "00 Test Address at Test City, State and Country",
            'registeration_type' => "autogenerated"
        ]);

        $bernard = User::create([
            'company_id' => $company['id'],
            'state_id' => $benue_state["id"],
            'firstname' => "Bernard",
            'lastname' => "Iorver",
            'othername' => "Bemshima",
            'role' => Roles::SUPER_ADMIN_USER,
            'email' => "bernard.iorver28@gmail.com",
            'password' => Hash::make(env('BENION_ADMIN_PASSWORD')),
            'gender' => "male",
            'phone' => "+2348168766556",
            'address' => "28 Gyan Amap Close, Gboko, Benue State, Nigeria",
            'registeration_type' => "autogenerated"
        ]);

        PlateNumber::create([
            'company_id' => $company['id'],
            'state_id' => $fct_state['id'], // Using FCT state ID
            'creator_id' => $admin_user['id'],
            'number' => 'ABC-123-XYZ',
            'number_status' => 'Paid',
            'status' => 'Sold',
            'agent_id' => 'AGENT-001',
            'owner_id' => 'OWNER-001',
            'request_id' => 'REQ-12345',
            'stock_id' => 'STK-6789',
            'type' => 'Private',
            'sub_type' => 'Direct',
        ]);
    
        PlateNumber::create([
            'company_id' => $company['id'],
            'state_id' => $kaduna_state['id'], // Using Kaduna state ID
            'creator_id' => $super_user['id'],
            'number' => 'XYZ-789-ABC',
            'number_status' => 'Paid',
            'status' => 'Sold',
            'agent_id' => 'AGENT-002',
            'owner_id' => 'OWNER-002',
            'request_id' => 'REQ-67890',
            'stock_id' => 'STK-1234',
            'type' => 'Private',
            'sub_type' => 'Direct',
        ]);

        PlateNumberOrder::create([
            'company_id' => $company['id'],
            'state_id' => $fct_state['id'], // Using FCT state ID
            'creator_id' => $admin_user['id'],
            'invoice_id' => 'INV-001',
            'vehicle_id' => 'VEH-001',
            'type' => 'Request',
            'status' => 'Pending',
            'assignment_status' => 'Unassigned',
            'fancy_plate' => 'ABC-001',
            'prefix' => 21,
            'recommended_number' => 123,
            'total_number_requested' => 10,
            'tracking_id' => 'TRK-001',
            'workflow_approval_status' => 'Pending',
            'plate_number_type' => 'Private',
            'plate_number_sub_type' => 'Direct',
            'workflow_id' => 'WFL-12345',
            'reference_number' => 'REF-67890',
        ]);

        PlateNumberOrder::create([
            'company_id' => $company['id'],
            'state_id' => $benue_state['id'], // Using Benue state ID
            'creator_id' => $bernard['id'],
            'invoice_id' => 'INV-003',
            'vehicle_id' => 'VEH-003',
            'type' => 'Request',
            'status' => 'Pending',
            'assignment_status' => 'Unassigned',
            'fancy_plate' => 'DEF-003',
            'prefix' => 23,
            'recommended_number' => 789,
            'total_number_requested' => 15,
            'tracking_id' => 'TRK-003',
            'workflow_approval_status' => 'Pending',
            'plate_number_type' => 'Private',
            'plate_number_sub_type' => 'Direct',
            'workflow_id' => 'WFL-34567',
            'reference_number' => 'REF-34567',
        ]);

        PlateNumberOrder::create([
            'company_id' => $company['id'],
            'state_id' => $kaduna_state['id'], // Using Kaduna state ID
            'creator_id' => $bernard['id'],
            'invoice_id' => 'INV-002',
            'vehicle_id' => 'VEH-002',
            'type' => 'Sale',
            'status' => 'Pending',
            'assignment_status' => 'Unassigned',
            'fancy_plate' => 'XYZ-002',
            'prefix' => 22,
            'recommended_number' => 456,
            'total_number_requested' => 5,
            'tracking_id' => 'TRK-002',
            'workflow_approval_status' => 'Pending',
            'plate_number_type' => 'Commercial',
            'plate_number_sub_type' => 'Direct',
            'workflow_id' => 'WFL-67890',
            'reference_number' => 'REF-12345',
        ]);

        PlateNumberOrder::create([
            'company_id' => $company['id'],
            'state_id' => $fct_state['id'], // Using FCT state ID
            'creator_id' => $bernard['id'],
            'invoice_id' => 'INV-004',
            'vehicle_id' => 'VEH-004',
            'type' => 'Sale',
            'status' => 'Pending',
            'assignment_status' => 'Unassigned',
            'fancy_plate' => 'GHI-004',
            'prefix' => 24,
            'recommended_number' => 321,
            'total_number_requested' => 8,
            'tracking_id' => 'TRK-004',
            'workflow_approval_status' => 'Pending',
            'plate_number_type' => 'Private',
            'plate_number_sub_type' => 'Direct',
            'workflow_id' => 'WFL-45678',
            'reference_number' => 'REF-45678',
        ]);
    }
}
