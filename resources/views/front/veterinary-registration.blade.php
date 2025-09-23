<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Vet Registration / Signup Form</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    .form-section {
      background-color: #f7f9fc;
      padding: 30px;
      border-radius: 10px;
      margin: 40px auto;
      max-width: 800px;
      box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
    }

    .form-title {
      font-size: 26px;
      font-weight: 700;
      color: #003873;
      margin-bottom: 30px;
    }

    .form-group label {
      font-weight: 600;
    }

    .btn-submit {
      background-color: #003873;
      color: white;
      border-radius: 30px;
      padding: 10px 30px;
    }

    .form-check-label {
      font-weight: 500;
    }
  </style>
</head>
<body>

  <section class="form-section">
    <h2 class="form-title text-center">Vet Registration / Signup Form</h2>
    <form>

      <div class="form-group">
        <label>Full Name</label>
        <input type="text" class="form-control" placeholder="Enter your full name" required>
      </div>

      <div class="form-group">
        <label>Email ID</label>
        <input type="email" class="form-control" placeholder="Enter your email" required>
      </div>

      <div class="form-group">
        <label>Mobile Number</label>
        <input type="tel" class="form-control" placeholder="Enter your mobile number" required>
      </div>

      <div class="form-group">
        <label>Select Vet</label>
        <select class="form-control" required>
          <option value="">-- Select Vet --</option>
          <option value="dog">Dog Vet</option>
          <option value="cat">Cat Vet</option>
          <option value="bird">Bird Vet</option>
          <!-- Add more options as needed -->
        </select>
      </div>

      <div class="form-group">
        <label>Total Experience (in years)</label>
        <input type="number" class="form-control" placeholder="e.g. 5" required>
      </div>

      <div class="form-group">
        <label>Enter Your Registration Number</label>
        <input type="text" class="form-control" placeholder="Enter your registration number" required>
      </div>

      <div class="form-group">
        <label>Enter Registered Body</label>
        <input type="text" class="form-control" placeholder="Enter your registered body" required>
      </div>

      <div class="form-group">
        <label>Current Employer</label>
        <input type="text" class="form-control" placeholder="Enter your current employer" required>
      </div>

      <div class="form-group">
        <label>Select Region / State</label>
        <select class="form-control" required>
          <option value="">-- Select State --</option>
          <option>Delhi</option>
          <option>Maharashtra</option>
          <option>Karnataka</option>
          <option>Tamil Nadu</option>
          <!-- Add more states -->
        </select>
      </div>

      <div class="form-group">
        <label>Select City</label>
        <select class="form-control" required>
          <option value="">-- Select City --</option>
          <option>Delhi</option>
          <option>Mumbai</option>
          <option>Bangalore</option>
          <option>Chennai</option>
          <!-- Add more cities -->
        </select>
      </div>

      <div class="form-group">
        <label>Enter Zip Code</label>
        <input type="text" class="form-control" placeholder="Enter your zip code" required>
      </div>

      <div class="form-group">
        <label>Describe About You</label>
        <textarea class="form-control" rows="4" placeholder="Write about yourself" required></textarea>
      </div>

      <div class="form-group">
        <label>Upload Profile Picture</label>
        <input type="file" class="form-control" accept="image/*" required>
      </div>

      <div class="form-group">
        <label>Upload Registration Certificate</label>
        <input type="file" class="form-control" accept="application/pdf,image/*" required>
      </div>

      <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" id="terms" required>
        <label class="form-check-label" for="terms">I Accept the Terms & Conditions</label>
      </div>

      <div class="text-center">
        <button type="submit" class="btn btn-submit">Submit</button>
      </div>

    </form>
  </section>

</body>
</html>
