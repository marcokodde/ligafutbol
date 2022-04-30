<div>
   El total es: {{ $total}}

    <div class="flex">
        <button wire:click="sumar" class="button green rounded-lg hover:text-black">
            {{__("Sumar")}}
        </button>

        <button wire:click="restar" class="button red rounded-lg hover:text-black">
            {{__("Restar")}}
        </button>
    </div>

</div>
