<div class="w-full">
    <label for="{{ $field->name }}" class="form-label w-full">
        {{ $field->label }}
    </label>
    @include('tall-forms::fields.error-help')
    <div class="w-full mt-2">
        @if(isset($form_data[$field->name]) && $form_data[$field->name])
        <div class="flex flex-col divide-y mb-2 {{ $field->group_class }}">
            @foreach($form_data[$field->name] as $key => $value)
            <div class="py-2">
                <div class="flex px-2 space-x-3">
                    <div class="flex-1 sm:grid sm:grid-cols-12 col-gap-2 row-gap-4">
                        @foreach($field->array_fields as $array_field)
                        @php $bind = "{$field->key}.{$key}.{$array_field->name}" @endphp
                        @include('tall-forms::array-fields.' . $array_field->type)
                        @endforeach
                    </div>
                    <div class="flex-shrink space-x-2 items-center justify-end">
                        @if($field->array_sortable)
                        <button class="border rounded border px-1"
                            wire:click="arrayMoveUp('{{ $field->name }}', '{{ $key }}')">
                            @svg('light/arrow-up', 'h-4 w-4')
                        </button>

                        <button class="border rounded border px-1"
                            wire:click="arrayMoveDown('{{ $field->name }}', '{{ $key }}')">
                            @svg('light/arrow-down', 'h-4 w-4')
                        </button>
                        @endif

                        <button class="rounded bg-aurora-red shadow px-1 text-white"
                            onclick="confirm('{{ __('Are you sure?') }}') || event.stopImmediatePropagation();"
                            wire:click="arrayRemove('{{ $field->name }}', '{{ $key }}')">
                            @svg('light/trash', 'h-4 w-4')
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
        <button class="rounded-md shadow-sm text-white bg-aurora-green" wire:click="arrayAdd('{{ $field->name }}')" style="width:fit-content">
            @svg('light/plus-circle', 'h-5 w-5 m-2')
        </button>
    </div>
</div>