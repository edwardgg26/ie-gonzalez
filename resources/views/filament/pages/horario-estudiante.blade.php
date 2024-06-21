<x-filament-panels::page>
    @foreach ($grados_alumno as $grado_alumno)
        <livewire:horario-alumno :grado_alumno="$grado_alumno" :key="$grado_alumno->grado_id">
    @endforeach
</x-filament-panels::page>