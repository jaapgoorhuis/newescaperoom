@php
$isCustomPlaceholder = isset($placeholder);
@endphp

@props([
    'multiple' => false,
    'required' => false,
    'disabled' => false,
   'acceptedFileTypes' => ['image/png'],
    'placeholder' => __('Drag & Drop your files or <span class="filepond--label-action"> Browse </span>'),
])

@php
if (! $wireModelAttribute = $attributes->whereStartsWith('wire:model')->first()) {
    throw new Exception("You must wire:model to the filepond input.");
}

$pondProperties = $attributes->except([
    'class',
    'placeholder',
    'required',
    'multiple',
    'disabled',
    'acceptedFileTypes',
    'wire:model',
]);


// convert keys from kebab-case to camelCase
$pondProperties = collect($pondProperties)
    ->mapWithKeys(fn ($value, $key) => [Illuminate\Support\Str::camel($key) => $value])
    ->toArray();


$fileTypeAccepted = ['image/*','application/pdf','video/*'];



$pondLocalizations = __('livewire-filepond::filepond');
@endphp
<div
    class="{{ $attributes->get('class') }}"
    wire:ignore
    x-cloak
    x-data="{
        model: @entangle($wireModelAttribute),
        isMultiple: @js($multiple),
        current: undefined,
        files: [],
        async loadModel() {

        }
    }"
    x-init="async () => {
      await loadModel();

      const pond = LivewireFilePond.create($refs.input);

      pond.setOptions({
           onaddfilestart: (file) => { isLoadingCheck(files); },
            onprocessfile: (files) => { isLoadingCheck(files); },
            onremovefile: (error, file) => { isRemovingFile(error,file);},
            onprocessfiles: (files) => { isFinished(files); },
            onerror: (files) =>  {
            console.log('error');
              buttonDisabled = false
            },
           allowVideoPreview: true,

            allowMultiple: @js($multiple),

            acceptedFileTypes: @js($fileTypeAccepted),

          server: {
              process: async (fieldName, file, metadata, load, error, progress) => {

                  $dispatch('filepond-upload-started', '{{ $wireModelAttribute }}');
                  await @this.upload('{{ $wireModelAttribute }}', file, async (response) => {
                    let validationResult  = await @this.call('validateUploadedFile', response);


                        // Check server validation result
                        console.log(validationResult);

                        if (validationResult === true) {
                            // File is valid, dispatch the upload-finished event
                            load(response);
                            $dispatch('filepond-upload-finished', { '{{ $wireModelAttribute }}': response });
                        } else {
                            // Throw error after validating server side
                            error('Filepond Api Ignores This Message');
                            $dispatch('filepond-upload-reset', '{{ $wireModelAttribute }}');
                              buttonDisabled = true
                        }
                  }, error, progress);
              },
              load: (source, load, error, progress, abort, headers) => {
                var myRequest = new Request(source);
                fetch(myRequest).then((res) => {
                    return res.blob();
                }).then(load);
            },
              revert: async (filename, load) => {
                  await @this.revert('{{ $wireModelAttribute }}', filename, load);
                  $dispatch('filepond-upload-reverted', {'attribute' : '{{ $wireModelAttribute }}'});
              },
              remove: async (file, load) => {
                  await @this.remove('{{ $wireModelAttribute }}', file.name);
                  load();


                  $dispatch('filepond-upload-file-removed', {'attribute' : '{{ $wireModelAttribute }}'});
              },



          },
          required: @js($required),
          disabled: @js($disabled),
      });


      pond.setOptions(@js($pondLocalizations));


      @if($isCustomPlaceholder)
      pond.setOptions({ labelIdle: @js($placeholder) });
      @endif

      pond.addFiles(files)
      pond.on('addfile', (error, file) => {
          if (error) console.log(error);
      });

      function isLoadingCheck(){
            var isLoading = pond.getFiles().filter(x=>x.status !== 5).length !== 0;
            if(isLoading) {
               buttonDisabled = true

            } else {
             console.log('doneloading');
             buttonDisabled = false
             @this.call('uploadFiles');

            }
        }
        function isRemovingFile(error,file){
            Livewire.dispatch('removeFiles', {filename: file.serverId});
        }

          function isFinished() {

      }
      this.addEventListener('pondCompleteReset', e => {
            pond.removeFiles();
      });

      this.addEventListener('pondReset', e => {
            pond.removeFile(e);
        });

    }"
>

    <script>


    </script>

    <input type="file" x-ref="input">
</div>
