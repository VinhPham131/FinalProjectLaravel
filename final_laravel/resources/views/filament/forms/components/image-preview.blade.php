<x-dynamic-component
    :component="$getFieldWrapperView()"
    :id="$getId()"
    :label="$getLabel()"
    :label-sr-only="$isLabelHidden()"
    :helper-text="$getHelperText()"
    :hint="$getHint()"
    :hint-color="$getHintColor()"
    :hint-icon="$getHintIcon()"
    :required="$isRequired()"
    :state-path="$getStatePath()"
>
    <div x-data="{ state: @entangle($getStatePath()) }">
        <img :src="state" style="height: 185px;" class="object-cover" x-show="state" />
        <div x-show="!state" class="text-gray-500">No image available</div>
    </div>
    @if ($getHintActions())
        <div class="mt-2">
            @foreach ($getHintActions() as $action)
                <x-dynamic-component :component="$action->getComponent()" :action="$action" />
            @endforeach
        </div>
    @endif
</x-dynamic-component>