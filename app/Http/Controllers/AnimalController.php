<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Cage;
use App\Http\Requests\StoreAnimalRequest;
use App\Http\Requests\UpdateAnimalRequest;
use Illuminate\Support\Facades\Storage;

class AnimalController extends Controller
{
    /**
     * Показать список всех животных
     */
    public function index()
    {
        $animals = Animal::with('cage')->get();
        return view('animals.index', compact('animals'));
    }

    /**
     * Показать форму создания нового животного
     */
    public function create()
    {
        $cages = Cage::whereRaw('capacity > (SELECT COUNT(*) FROM animals WHERE cage_id = cages.id)')
            ->orWhereDoesntHave('animals')
            ->get();
        
        return view('animals.create', compact('cages'));
    }

    /**
     * Сохранить новое животное
     */
    public function store(StoreAnimalRequest $request)
    {
        $data = $request->validated();
        
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('animals', 'public');
        }
        
        Animal::create($data);
        
        return redirect()->route('animals.index')
            ->with('success', 'Животное успешно добавлено!');
    }

    /**
     * Показать конкретное животное
     */
    public function show(Animal $animal)
    {
        $animal->load('cage');
        return view('animals.show', compact('animal'));
    }

    /**
     * Показать форму редактирования животного
     */
    public function edit(Animal $animal)
    {
        $cages = Cage::whereRaw('capacity > (SELECT COUNT(*) FROM animals WHERE cage_id = cages.id)')
            ->orWhere('id', $animal->cage_id)
            ->get();
        
        return view('animals.edit', compact('animal', 'cages'));
    }

    /**
     * Обновить животное
     */
    public function update(UpdateAnimalRequest $request, Animal $animal)
    {
        $data = $request->validated();
        
        if ($request->hasFile('image')) {
            // Удаляем старое изображение
            if ($animal->image) {
                Storage::disk('public')->delete($animal->image);
            }
            $data['image'] = $request->file('image')->store('animals', 'public');
        }

        $animal->update($data);

        return redirect()->route('animals.index')
            ->with('success', 'Информация о животном успешно обновлена!');
    }

    /**
     * Удалить животное
     */
    public function destroy(Animal $animal)
    {
        if ($animal->image) {
            Storage::disk('public')->delete($animal->image);
        }
        
        $animal->delete();

        return redirect()->route('animals.index')
            ->with('success', 'Животное успешно удалено!');
    }
}
