
function fire(image, imageType) {
    const evt = new CustomEvent("drag-and-drop-event", { detail: { image, imageType } });
    document.dispatchEvent(evt);
}

const onChangeFile = (file, imageType) => {
    fire(file, imageType);
};

if ($('.drag-area').length > 0) {
    //selecting all required elements
    const dropArea = document.querySelector(".drag-area"),
        dragText = dropArea.querySelector("header"),
        button = dropArea.querySelector("label[type=\"button\"]"),
        dropAreaInner = dropArea.querySelector(".drag-area-inner"),
        input = dropArea.querySelector("input[type=\"file\"]"),
        customExtensions = dropArea.querySelector("input[name=\"file_extensions\"]");
    let file; //this is a global variable and we'll use it inside multiple functions

    // button.onclick = () => {
    //     input.click(); //if user click on the button then the input also clicked
    // }

    input.addEventListener("change", function() {
        //getting user select file and [0] this means if user select multiple files then we'll select only the first one
        file = this.files[0];
        dropArea.classList.add("active");
        showFile(); //calling function
    });

    //If user Drag File Over DropArea
    dropArea.addEventListener("dragover", (event) => {
        event.preventDefault(); //preventing from default behaviour
        dropArea.classList.add("active");
        dragText.textContent = "Release to Upload File";
    });

    //If user leave dragged File from DropArea
    dropArea.addEventListener("dragleave", () => {
        dropArea.classList.remove("active");
        dragText.innerHTML = `Drag & Drop to Upload File, or <label for="upload-image" type="button">browse</label>`;
    });

    //If user drop File on DropArea
    dropArea.addEventListener("drop", (event) => {
        event.preventDefault(); //preventing from default behaviour
        //getting user select file and [0] this means if user select multiple files then we'll select only the first one
        file = event.dataTransfer.files[0];
        input.files = event.dataTransfer.files;
        showFile(); //calling function
    });

    function showFile() {
        let fileType = file.type; //getting selected file type
        const imageType = dropArea.querySelector("input[name=\"image_type\"]").value;
        let validExtensions = ["image/jpeg", "image/jpg", "image/png"]; //adding some valid image extensions in array

        if (imageType === 'gif') {
            validExtensions = ["image/gif"];
        }

        if (customExtensions) {
            validExtensions = customExtensions.value.split(',').map(ex => `image/${ex.trim()}`);
        }

        if (validExtensions.includes(fileType)) { //if user selected file is an image file
            let fileReader = new FileReader(); //creating new FileReader object
            fileReader.onload = () => {
                let fileURL = fileReader.result; //passing user file source in fileURL variable

                //creating an img tag and passing user selected file source inside src attribute
                dropAreaInner.innerHTML = `<img src="${fileURL}" alt="">`; //adding that created img tag inside dropArea container
                onChangeFile(fileURL, imageType);
            }
            fileReader.readAsDataURL(file);
        } else {
            input.value = "";
            alert("Please upload valid image!");
            dropArea.classList.remove("active");
            dragText.innerHTML = `Drag & Drop to Upload File, or <label for="upload-image" type="button">browse</label>`;
        }
    }
}
