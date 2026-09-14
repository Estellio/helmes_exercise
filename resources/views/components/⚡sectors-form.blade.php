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

        // Call the function to repopulate the form fields with the saved data
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

        // Check if an entry exists with the same session ID, if it does, update the existing one and if not then create it
        $formSubmission = FormSubmission::updateOrCreate(
            ['session_id' => session()->getId()],
            [
                'name' => $this->name,
                'accept_terms' => $this->acceptTerms
            ]
        );

        $formSubmission->sectors()->sync($this->selectedSectors);

        // Clear the form values
        $this->reset([
            'name',
            'selectedSectors',
            'acceptTerms'
        ]);

        // Refetch and populate the form fields
        $this->fetchSavedData();

        session()->flash('success', 'Form submitted successfully!');
    }
};
?>

<form wire:submit="save" class="flex flex-col gap-y-4">
    <div class="w-full min-w-[200px]">
        <label for="name" class="block mb-2 text-sm">
            Name:
        </label>

        <input type="text" wire:model="name" id="name"
        class="w-full bg-gray-900 text-sm border border-slate-600 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-indigo-500 hover:border-indigo-400 shadow-sm focus:shadow" />
        
        <div>
            @error('name') 
                @include('components.validation-error', [
                    'message' => $message
                ])
            @enderror
        </div>
    </div>

    <div class="w-full min-w-[200px]">
        <label for="selectedSectors" class="block mb-2 text-sm">
            Sectors:
        </label>

        <div class="w-full max-h-[400px] p-2 bg-gray-900 rounded-lg border border-slate-600 overflow-y-auto scrollbar-thumb-indigo-500/60 scrollbar-track-gray-700/10">
            <ul class="space-y-1">
                @foreach ($sectors as $sector)
                    @include('components.sector-option', [
                        'sector' => $sector,
                        'level' => 0
                    ])
                @endforeach
            </ul>
        </div>

        <div>
            @error('selectedSectors') 
                @include('components.validation-error', [
                    'message' => $message
                ])
            @enderror
        </div>
    </div>

    <div>
        <input type="checkbox" wire:model="acceptTerms" id="acceptTerms"
        class="shrink-0 size-4 bg-gray-600 border-line-3 rounded-sm shadow-2xs text-indigo-600 focus:ring-0 focus:ring-offset-0 checked:bg-indigo-600 checked:border-primary-checked">
        
        <label for="acceptTerms" class="ml-1 text-sm">
            Agree to terms
        </label>
    
        <div>
            @error('acceptTerms') 
                @include('components.validation-error', [
                    'message' => $message
                ])
            @enderror
        </div>
    </div>

    <div class="flex justify-center">
        <button type="submit" class="w-full text-white bg-indigo-600 hover:bg-indigo-500 shadow-xs leading-5 rounded-sm text-sm uppercase px-4 py-2.5">
            Save
        </button>
    </div>

    @if (session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
        class="p-4 text-sm text-fg-success-strong rounded-base bg-success-soft border border-success-subtle" role="alert">
            {{ session('success') }}
        </div>
    @endif
            
</form>