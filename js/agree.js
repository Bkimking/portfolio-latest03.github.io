
document.addEventListener("DOMContentLoaded", function () {
    // Handle click event for Privacy link
    document.getElementById('privacy-link').addEventListener('click', function (event) {
        event.preventDefault(); // Prevent default link behavior
        showAgreementDialog('Privacy');
    });

    // Handle click event for Terms link
    document.getElementById('terms-link').addEventListener('click', function (event) {
        event.preventDefault(); // Prevent default link behavior
        showAgreementDialog('Terms');
    });

    // Function to show SweetAlert dialog with checkbox
    function showAgreementDialog(type) {
        Swal.fire({
            title: `${type} Agreement`,
            html: `I agree to the ${type}.<br><input type="checkbox" id="agreement-checkbox">`,
            showCancelButton: true,
            confirmButtonText: 'Agree',
            cancelButtonText: 'Cancel',
            preConfirm: () => {
                const checkbox = document.getElementById('agreement-checkbox');
                if (!checkbox.checked) {
                    Swal.showValidationMessage('Please agree to the terms.');
                }
                return { agreed: checkbox.checked };
            }
        }).then((result) => {
            if (result.isConfirmed) {
                const agreed = result.value.agreed;
                if (agreed) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Agreement Accepted!',
                        text: `You have agreed to the ${type}.`
                    });
                }
            }
        });
    }
})
