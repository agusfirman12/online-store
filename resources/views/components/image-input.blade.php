@props([
    'name' => '',
    'height' => 'h-36',
])

<div class="flex items-center justify-center w-full">
    <label for="dropzone-file" id="dropzone-label"
        class="flex flex-col items-center justify-center w-full {{ $height }} border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50  hover:bg-orange-50">
        <div id="image-view"
            class="flex flex-col items-center justify-center pt-5 pb-6 {{ $height }} rounded-lg object-center object-cover w-full overflow-hidden">
            <i class='bx bx-cloud-upload text-5xl text-gray-500'></i>
            <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to upload</span>
                or drag and drop</p>
            <p class="text-xs text-gray-500">JPG, PNG, SVG, JPEG Max 500kb</p>
        </div>
        <input id="dropzone-file" name="{{ $name }}" type="file" class="hidden" />
    </label>
</div>

<script>
    const fileInput = document.getElementById('dropzone-file');
    const imagePreview = document.getElementById('image-view');
    const dropZone = document.getElementById('dropzone-label');

    function uploadImage() {
        let imgLink = URL.createObjectURL(fileInput.files[0]);
        imagePreview.innerHTML = `<img src="${imgLink}" />`;
    }

    fileInput.addEventListener('change', uploadImage);

    dropZone.addEventListener('dragover', (e) => {
        e.preventDefault();
    });

    dropZone.addEventListener('drop', (e) => {
        e.preventDefault();
        fileInput.files = e.dataTransfer.files;
        uploadImage();
    });

    if (fileInput.value) {
        imagePreview.innerHTML = `<img src="${value}" />`;
    }
</script>
