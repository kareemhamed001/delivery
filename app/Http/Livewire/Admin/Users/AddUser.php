<?php

namespace App\Http\Livewire\Admin\Users;

use Livewire\Component;

class AddUser extends Component
{
    public $userType
//,$user_name, $email, $phone_number, $password, $user_type, $national_id, $moto_number, $moto_model, $year_of_getting_licence, $number_of_years_of_the_license
    ;
    function mount(){
        $this->userType=old('user_type');
    }
    public function render()
    {

        return view('livewire.admin.users.add-user');
    }
}
