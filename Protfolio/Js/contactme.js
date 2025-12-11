<script>
    const form = document.querySelector("form");

    form.addEventListener("submit", function (e) {
        e.preventDefault(); // page reload বন্ধ

        // input নেয়া
        let firstName = document.querySelector('input[name="firstname"]').value.trim();
        let lastName  = document.querySelector('input[name="lastname"]').value.trim();
        let email     = document.querySelector('input[name="email"]').value.trim();

        // radio check
        let reason = document.querySelector('input[name="reason"]:checked');

        // basic validation
        if (firstName === "") {
            alert("Please enter your First Name");
            return;
        }

        if (lastName === "") {
            alert("Please enter your Last Name");
            return;
        }

        if (email === "") {
            alert("Please enter your Email");
            return;
        }

        if (!email.includes("@")) {
            alert("Please enter a valid Email address");
            return;
        }

        if (!reason) {
            alert("Please select a reason for contact");
            return;
        }

        // যদি সব ঠিক থাকে
        alert("Form submitted successfully ✅");
        form.reset();
    });
</script>
