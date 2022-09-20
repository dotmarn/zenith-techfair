<?php

namespace App\Http\Livewire\Portal;

use App\Models\SuperSession;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class MasterClass extends Component
{
    use LivewireAlert;
    public $super_sessions, $title, $needed_participants, $description, $selected_id, $modal_title;

    protected $listeners = [
        'deleteConfirmed',
        'cancelled',
        'edit_data_updated'
    ];

    public function mount()
    {
        $this->modal_title = "Create Master Class";
    }

    public function edit_data_updated($data)
    {
        $this->modal_title = "Update ".$data['title'];
        $this->title = $data['title'];
        $this->needed_participants = $data['max_participants'];
        $this->description = $data['description'];
        $this->selected_id = $data['id'];
    }

    public function render()
    {
        $this->super_sessions = SuperSession::select('id', 'title', 'max_participants', 'description')->withCount('registrations')->get();
        return view('livewire.portal.master-class')->extends('layouts.portal.dashboard')->section('content');
    }

    public function createNew()
    {
        if (!is_null($this->selected_id) || $this->selected_id != '') {
            $rules = [
                'title' => ['required', 'string', 'unique:super_sessions,title,'.$this->selected_id],
                'needed_participants' => ['required', 'numeric'],
                'description' => ['nullable', 'string']
            ];
        } else {
            $rules = [
                'title' => ['required', 'string', 'unique:super_sessions,title'],
                'needed_participants' => ['required', 'numeric'],
                'description' => ['nullable', 'string']
            ];
        }

        $this->validate($rules);

        SuperSession::updateOrCreate([
            'id' => $this->selected_id
        ],
        [
            'title' => $this->title,
            'max_participants' => $this->needed_participants,
            'description' => $this->description
        ]);

        $message = $this->selected_id ? 'updated' : 'created';

        $this->resetFormInputs();

        return $this->alert('success', "Master class session {$message} successfully");
    }

    private function resetFormInputs() : void
    {
        $this->title = '';
        $this->needed_participants = '';
        $this->description = '';
        $this->selected_id = '';
    }
}
