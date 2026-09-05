<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait HasTrash
{
    protected function getResourceType()
    {
        return $this->type ?? Str::snake(Str::plural(class_basename($this->model)));
    }

    public function trash()
    {
        $items = $this->model::onlyTrashed();

        if (isset($this->trashWith)) {
            $items = $items->with($this->trashWith ?? []);
        }

        $items = $items->paginate(config('custom.pagination'));

        $resourceType = $this->getResourceType();
        $resourceName = Str::title(str_replace('_', ' ', $resourceType));

        return view('dashboard.common.trash', [
            'items'   => $items,
            'title'   => $this->trashTitle ?? "$resourceName Trash",
            'type'    => $resourceType,
            'headers' => $this->trashHeaders ?? ['ID', 'Name', 'Deleted At', 'Actions']
        ]);
    }

    public function restore($id)
    {
        $item = $this->model::withTrashed()->findOrFail($id);
        $item->restore();

        $resourceType = $this->getResourceType();

        return redirect()->route($this->routePath . 'trash')
            ->with('success', Str::title(Str::singular(str_replace('_', ' ', $resourceType))) . ' Restored Successfully!');
    }

    public function forceDelete($id)
    {
        $item = $this->model::withTrashed()->findOrFail($id);
        $item->forceDelete();

        $resourceType = $this->getResourceType();

        return redirect()->route($this->routePath . 'trash')
            ->with('success', Str::title(Str::singular(str_replace('_', ' ', $resourceType))) . ' Deleted Successfully!');
    }

    public function applyTrash($request, $query)
    {
        return $query->when($request->has('trash'), function ($q) {
            return $q->onlyTrashed();
        });
    }
}
