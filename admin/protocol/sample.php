<!DOCTYPE html>
<html lang="hi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Example</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-group {
            margin-bottom: 15px;
        }
        .shadow {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        .remove-btn {
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <div class="row" id="formContainer">
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="madhyam" placeholder="माध्यम" required name="madhyam">
                        <label for="madhyam">माध्यम<span class="text-danger">*</span> : </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="time" class="form-control" id="entry_time" placeholder=" " required name="entry_time">
                        <label for="entry_time">आगमन<span class="text-danger">*</span> : </label>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <input type="time" class="form-control" id="exit_time" placeholder=" " required name="exit_time">
                        <label for="exit_time">प्रस्थान<span class="text-danger">*</span> :</label>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group shadow">
                    <div class="form-floating mb-3">
                        <textarea class="form-control" id="comment" placeholder="टिप्पणी" required style="height: 80px;" name="details"></textarea>
                        <label for="comment">विवरण<span class="text-danger">*</span> : </label>
                    </div>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-primary" id="addMore">Add More</button>
    </div>

    <script>
        document.getElementById('addMore').addEventListener('click', function () {
            let formContainer = document.getElementById('formContainer');
            let newFields = document.createElement('div');
            newFields.className = 'row';

            newFields.innerHTML = `
                <div class="col-lg-6">
                    <div class="form-group shadow">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" placeholder="माध्यम" required name="madhyam">
                            <label>माध्यम<span class="text-danger">*</span> : </label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group shadow">
                        <div class="form-floating mb-3">
                            <input type="time" class="form-control" placeholder=" " required name="entry_time">
                            <label>आगमन<span class="text-danger">*</span> : </label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group shadow">
                        <div class="form-floating mb-3">
                            <input type="time" class="form-control" placeholder=" " required name="exit_time">
                            <label>प्रस्थान<span class="text-danger">*</span> :</label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group shadow">
                        <div class="form-floating mb-3">
                            <textarea class="form-control" placeholder="टिप्पणी" required style="height: 80px;" name="details"></textarea>
                            <label>विवरण<span class="text-danger">*</span> : </label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 text-end">
                    <button type="button" class="btn btn-danger remove-btn">Remove</button>
                </div>
            `;

            formContainer.appendChild(newFields);

            newFields.querySelector('.remove-btn').addEventListener('click', function () {
                formContainer.removeChild(newFields);
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
