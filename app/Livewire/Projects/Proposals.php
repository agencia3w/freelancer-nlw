<?php

namespace App\Livewire\Projects;

use App\Models\Project;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class Proposals extends Component
{
    const LOAD_MORE_RECORDS = 10;
    public Project $project;
    public int $limit = 10;

    #[Computed()]
    public function proposals()
    {
        return $this->project->proposals()
            ->orderBy('hours')
            ->orderBy('created_at', 'DESC')
            ->paginate($this->limit);
    }

    public function loadMore()
    {
        $this->limit += self::LOAD_MORE_RECORDS;
    }

    #[Computed()]
    public function lastProposalTime()
    {
        return $this->project->proposals()->latest()->first()->created_at->diffForHumans();
    }

    #[On('proposal::created')]
    public function render()
    {
        return view('livewire.projects.proposals');
    }
}
