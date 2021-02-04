<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Livewire;

use App\Http\Livewire\ListInput;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

final class ListInputTest extends TestCase
{
    use RefreshDatabase;

    public function testCanView()
    {
        Livewire::test(ListInput::class, ['name' => 'test', 'label' => 'testLabel'])
            ->assertSee('testLabel');
    }

    public function testCanAddItem()
    {
        Livewire::test(ListInput::class, ['name' => 'test', 'label' => 'testLabel'])
            ->set('value', 'kaas')
            ->call('add')
            ->assertSee('kaas')
            ->assertSet('value', '');
    }

    public function testCanRemoveItem()
    {
        Livewire::test(ListInput::class, [
            'name' => 'test',
            'label' => 'testLabel',
            'items' => ['kaas', 'broodje', 'mayo'],
        ])
            ->assertSee('broodje')
            ->assertSee('kaas')
            ->assertSee('mayo')
            ->call('remove', 1)
            ->assertSee('kaas')
            ->assertSee('mayo');
    }
}
