<?php

namespace App\Livewire\Projects;

use App\Models\Project;
use Livewire\Attributes\Computed;
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
            ->orderByDesc('hours')
            ->simplePaginate($this->limit);
    }

    public function loadMore()
    {
        $this->limit += self::LOAD_MORE_RECORDS;
    }

    public function render()
    {
        return view('livewire.projects.proposals');
    }
}
