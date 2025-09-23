<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Vet Help Form</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet"/>
  <style>
    body {
      background-color: #f0f2f5;
    }
    .form-wrapper {
      max-width: 800px;
      margin: 60px auto;
      background-color: #ffffff;
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    }
    .form-wrapper h2 {
      text-align: center;
      margin-bottom: 30px;
      font-weight: 600;
    }
    .btn-submit {
      background-color: #28a745;
      color: white;
      padding: 10px 30px;
      border-radius: 5px;
      border: none;
      transition: 0.3s ease;
    }
    .btn-submit:hover {
      background-color: #218838;
    }
  </style>
</head>
<body>

  <div class="container">
    <div class="form-wrapper">
      <h2>VET HELP FORM</h2>
      <form action="#" method="post" enctype="multipart/form-data">
        <div class="row g-3">

          <!-- Full Name -->
          <div class="col-md-6">
            <label class="form-label">Full Name</label>
            <input type="text" class="form-control" placeholder="Enter your full name" required />
          </div>

          <!-- Email -->
          <div class="col-md-6">
            <label class="form-label">Email Id</label>
            <input type="email" class="form-control" placeholder="Enter your email" required />
          </div>

          <!-- Mobile -->
          <div class="col-md-6">
            <label class="form-label">Mobile Number</label>
            <input type="tel" class="form-control" placeholder="Enter your mobile number" required />
          </div>

          <!-- Location -->
          <div class="col-md-6">
            <label class="form-label">Location</label>
            <input type="text" class="form-control" placeholder="Enter your location" required />
          </div>

          <!-- Vet Select -->
          <div class="col-md-12">
            <label class="form-label">Select Vet</label>
            <select class="form-select" required>
              <option value="">Select a vet</option>
              <option value="dog">Dog Specialist</option>
              <option value="cat">Cat Specialist</option>
              <option value="bird">Bird Specialist</option>
              <option value="other">Other</option>
            </select>
          </div>

          <!-- Description -->
          <div class="col-md-12">
            <label class="form-label">Describe the Problem</label>
            <textarea class="form-control" rows="4" placeholder="Explain your issue" required></textarea>
          </div>

          <!-- File Upload -->
          <div class="col-md-12">
            <label class="form-label">Upload File (PDF, JPG, JPEG, PNG, Max: 2MB)</label>
            <input type="file" class="form-control" accept=".pdf, .jpeg, .jpg, .png" required />
          </div>

          <!-- Terms -->
          <div class="col-12">
            <div class="form-check">
              <input type="checkbox" class="form-check-input" id="terms" required />
              <label class="form-check-label" for="terms">I Agree to the Terms & Conditions</label>
            </div>
          </div>

          <!-- Submit -->
          <div class="col-12 text-center mt-3">
            <button type="submit" class="btn btn-submit">
              <i class="fas fa-check-circle me-2"></i>Submit
            </button>
          </div>

        </div>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
