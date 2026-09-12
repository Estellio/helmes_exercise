<?php

use Livewire\Component;
use Illuminate\Validation\Rule;
use App\Models\Sector;
use App\Models\FormSubmission;

new class extends Component
{
    public $sectors = [];
    public $name = '';
    public $selectedSectors = [];
    public $acceptTerms = false;

    public function mount()
    {
        // Fetch all the top level sectors and their children
        $this->sectors = Sector::whereNull('parent_sector_number')
            ->with('allChildren')
            ->orderBy('sector_number')
            ->get();

        // Call teh function to repopulate teh form fields with the saved data
        $this->fetchSavedData();
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|min:2|max:100',
            'selectedSectors' => 'required|array|min:1|max:5',
            'acceptTerms' => 'accepted'
        ];
    }

    public function fetchSavedData()
    {
        // Fetch the stored form data that matches the current session ID
        $formSubmission = FormSubmission::with('sectors')
            ->where('session_id', session()->getId())
            ->first();

        if ($formSubmission) {
            $this->name = $formSubmission->name;
            $this->acceptTerms = $formSubmission->accept_terms;

            $this->selectedSectors = $formSubmission->sectors
                ->pluck('sector_number')
                ->toArray();
        }
    }

    public function save()
    {
        $this->validate();

        $formSubmission = FormSubmission::updateOrCreate(
            ['session_id' => session()->getId()],
            [
                'name' => $this->name,
                'accept_terms' => $this->acceptTerms
            ]
        );

        $formSubmission->sectors()->sync($this->selectedSectors);

        // Clear teh form values
        $this->reset([
            'name',
            'selectedSectors',
            'acceptTerms'
        ]);

        // Refetch and populate the form fields
        $this->fetchSavedData();
    }
};
?>

<form wire:submit="save">
    <label for="name">Name:</label> 
    <input type="text" wire:model="name" id="name">
    
    <div>
        @error('name') 
        <div class="p-4 mb-4 text-sm text-fg-danger-strong rounded-base bg-danger-soft" role="alert">
            {{ $message }}
        </div>
        @enderror
    </div>
            
    <br>
    <br>
    
    <label for="selectedSectors">Sectors:</label>
    <select id="selectedSectors"  wire:model="selectedSectors" multiple size="8">
        @foreach ($sectors as $sector)
            @include('components.sector-option', [
                'sector' => $sector,
                'level' => 0
            ])
        @endforeach
    </select>

    <div>
        @error('selectedSectors') 
        <div class="p-4 mb-4 text-sm text-fg-danger-strong rounded-base bg-danger-soft" role="alert">
            {{ $message }}
        </div>
        @enderror
    </div>

    <br>
    <br>
            
    <input type="checkbox" wire:model="acceptTerms" id="acceptTerms">
    <label for="acceptTerms">Agree to terms</label>
    
    <div>
        @error('acceptTerms') 
        <div class="p-4 mb-4 text-sm text-fg-danger-strong rounded-base bg-danger-soft" role="alert">
            {{ $message }}
        </div>
        @enderror
    </div>

    <br>
    <br>
            
    <button type="submit">Save</button>
    <div>
        {{ session()->getId() }}
    </div>
</form>