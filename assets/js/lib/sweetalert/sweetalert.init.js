document.addEventListener('DOMContentLoaded', function() {
    var sweetPromptElement = document.querySelector('.sweet-prompt');
    if (sweetPromptElement) {
        sweetPromptElement.onclick = function() {
            swal({
                    title: "Enter an input !!",
                    text: "Write something interesting !!",
                    type: "input",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    animation: "slide-from-top",
                    inputPlaceholder: "Write something"
                },
                function(inputValue) {
                    if (inputValue === false) return false;
                    if (inputValue === "") {
                        swal.showInputError("You need to write something!");
                        return false;
                    }
                    swal("Hey !!", "You wrote: " + inputValue, "success");
                });
        };
    } else {
        console.warn('The element .sweet-prompt was not found.');
    }
});
