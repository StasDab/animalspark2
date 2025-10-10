<?php

namespace App\Http\Controllers;

use App\Models\Cage;
use App\Models\Animal;
use App\Http\Requests\StoreCageRequest;
use App\Http\Requests\UpdateCageRequest;
use Illuminate\Support\Facades\Storage;

class CageController extends Controller
{
    /**
     * Показать список всех клеток
     */
    public function index()
    {
        $cages = Cage::with('animals')->get();
        $totalAnimals = Animal::count();
        
        return view('cages.index', compact('cages', 'totalAnimals'));
    }

    /**
     * Показать форму создания новой клетки
     */
    public function create()
    {
        return view('cages.create');
    }

    /**
     * Сохранить новую клетку
     */
    public function store(StoreCageRequest $request)
    {
        Cage::create($request->validated());
        
        return redirect()->route('cages.index')
            ->with('success', 'Клетка успешно создана!');
    }

    /**
     * Показать конкретную клетку
     */
    public function show(Cage $cage)
    {
        $cage->load('animals');
        return view('cages.show', compact('cage'));
    }

    /**
     * Показать форму редактирования клетки
     */
    public function edit(Cage $cage)
    {
        return view('cages.edit', compact('cage'));
    }

    /**
     * Обновить клетку
     */
    public function update(UpdateCageRequest $request, Cage $cage)
    {
        $cage->update($request->validated());
        
        return redirect()->route('cages.index')
            ->with('success', 'Клетка успешно обновлена!');
    }

    /**
     * Удалить клетку
     */
    public function destroy(Cage $cage)
    {
        if ($cage->animal_count > 0) {
            return redirect()->route('cages.index')
                ->with('error', 'Нельзя удалить клетку с животными! Сначала переселите всех животных.');
        }

        $cage->delete();
        
        return redirect()->route('cages.index')
            ->with('success', 'Клетка успешно удалена!');
    }
}
