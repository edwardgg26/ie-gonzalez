<div>
    <h2 class="text-2xl dark:text-white mb-2 font-bold">
        {{$grado_alumno->grado->tipogrado->num.'-'.$grado_alumno->grado->group.' '.$grado_alumno->grado->year}}
    </h2>
    {{ $this->table }}
</div>
