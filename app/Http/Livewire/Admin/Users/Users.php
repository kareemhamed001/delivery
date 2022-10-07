<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $pageTitle, $count, $filterValue = '', $term, $userId;

    function emptyFields()
    {
        $this->userId = null;
    }

    function setId($id)
    {
        $this->userId = $id;
        if ($this->userId) {
            $this->dispatchBrowserEvent('open-delete-modal');
        } else {
            $this->dispatchBrowserEvent('close-delete-modal');
            toastr()->error('Try again');
        }

    }

    function confirmDelete()
    {

        $user = User::find($this->userId);
        if ($user) {
            if ($user->id == Auth::id()) {
                toastr()->error('You cant delete your self');
                $this->dispatchBrowserEvent('close-delete-modal');
                $this->emptyFields();

            } else {

                $user->delete();

                toastr()->success('Deleted successfully');
                $this->dispatchBrowserEvent('close-delete-modal');
                $this->emptyFields();

            }
            $this->dispatchBrowserEvent('close-delete-modal');

        } else {

            toastr()->error('This user doesnt exists');
            $this->dispatchBrowserEvent('close-delete-modal');
            $this->emptyFields();
        }
    }

    public function render()
    {
        if ($this->filterValue == 0) {
            $this->pageTitle = 'Users';
            $this->count = User::where('role_as', 0)->count();

        } else if ($this->filterValue == 1) {
            $this->pageTitle = 'Drivers';
            $this->count = User::where('role_as', 1)->count();
        } else if ($this->filterValue == 2) {
            $this->pageTitle = 'Admins';
            $this->count = User::where('role_as', 2)->count();
        } else if ($this->filterValue == 3) {
            $this->pageTitle = 'Guests';
            $this->count = User::where('role_as', 3)->count();
        } else {
            $this->pageTitle = 'All';
            $this->count = User::count();
        }

        if ($this->filterValue == 0 || $this->filterValue == 1 || $this->filterValue == 2) {
            $users = User::query()
                ->where('role_as', $this->filterValue)
                ->where(function ($query) {
                    $query->where('id', 'like', '%' . $this->term . '%');
                    $query->orWhere('name', 'like', '%' . $this->term . '%');
                    $query->orWhere('email', 'like', '%' . $this->term . '%');
                    $query->orWhere('phone_number', 'like', '%' . $this->term . '%');
                })
                ->paginate(25);

        } else {
            $users = User::query()
                ->where(function ($query) {
                    $query->where('id', 'like', '%' . $this->term . '%');
                    $query->orWhere('name', 'like', '%' . $this->term . '%');
                    $query->orWhere('email', 'like', '%' . $this->term . '%');
                    $query->orWhere('phone_number', 'like', '%' . $this->term . '%');
                })
                ->paginate(25);
        }


        return view('livewire.admin.users.users', compact('users'));
    }
}
