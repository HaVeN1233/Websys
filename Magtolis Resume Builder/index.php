<?php

$fields = [
    'name' => 'Full Name', 'phone' => 'Phone', 'email' => 'Email',
    'location' => 'Location', 'linkedin' => 'LinkedIn Profile', 'photo' => 'Profile Photo URL',
    'objective' => 'Career Objective', 'technical' => 'Technical Skills', 'soft' => 'Soft Skills',
    'job_title' => 'Job Title', 'company' => 'Company Name', 'start_date' => 'Start Date',
    'end_date' => 'End Date', 'responsibility1' => 'Key Responsibility / Achievement #1',
    'responsibility2' => 'Key Responsibility / Achievement #2',
    'responsibility3' => 'Key Responsibility / Achievement #3', 'degree' => 'Degree / Course',
    'university' => 'University / Institute', 'education_year' => 'Education Year',
    'cgpa' => 'CGPA / Grade', 'certification' => 'Certification Name',
    'certification_institute' => 'Certification Institute', 'certification_year' => 'Certification Year',
    'languages' => 'Languages', 'project_title' => 'Project / Internship Title',
    'project_company' => 'Project Company / Institute', 'project_description' => 'Project Description',
    'tools' => 'Tools / Technologies Used'
];

$values = array_fill_keys(array_keys($fields), '');
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($fields as $key => $label) {
        $values[$key] = trim((string) ($_POST[$key] ?? ''));
        if ($values[$key] === '') {
            $errors[$key] = $label . ' is required.';
        }
    }

    if ($values['email'] !== '' && !filter_var($values['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Please enter a valid email address.';
    }
    if ($values['phone'] !== '' && !preg_match('/^[0-9+()\- .]{7,20}$/', $values['phone'])) {
        $errors['phone'] = 'Please enter a valid phone number.';
    }
    foreach (['linkedin' => 'LinkedIn Profile', 'photo' => 'Profile Photo'] as $key => $label) {
        if ($values[$key] !== '' && !filter_var($values[$key], FILTER_VALIDATE_URL)) {
            $errors[$key] = 'Please enter a valid ' . $label . ' URL.';
        }
    }
    foreach (['education_year' => 'Education Year', 'certification_year' => 'Certification Year'] as $key => $label) {
        if ($values[$key] !== '' && !preg_match('/^\d{4}$/', $values[$key])) {
            $errors[$key] = $label . ' must be a four-digit year.';
        }
    }

    if (!$errors) {
        $_POST = $values;
        include __DIR__ . '/resume.php';
        exit;
    }
}

function oldValue($key, $values)
{
    return htmlspecialchars($values[$key] ?? '', ENT_QUOTES, 'UTF-8');
}

function fieldError($key, $errors)
{
    if (!isset($errors[$key])) {
        return '';
    }
    return '<p class="error" role="alert">' . htmlspecialchars($errors[$key], ENT_QUOTES, 'UTF-8') . '</p>';
}

function inputField($key, $label, $values, $errors, $type = 'text', $placeholder = '')
{
    $invalid = isset($errors[$key]) ? ' field-invalid' : '';
    $aria = isset($errors[$key]) ? ' aria-invalid="true"' : '';
    echo '<div class="field' . $invalid . '">';
    echo '<label for="' . $key . '">' . $label . '</label>';
    echo '<input id="' . $key . '" type="' . $type . '" name="' . $key . '" value="' . oldValue($key, $values) . '" placeholder="' . $placeholder . '"' . $aria . '>';
    echo fieldError($key, $errors) . '</div>';
}

function textareaField($key, $label, $values, $errors, $placeholder = '')
{
    $invalid = isset($errors[$key]) ? ' field-invalid' : '';
    $aria = isset($errors[$key]) ? ' aria-invalid="true"' : '';
    echo '<div class="field' . $invalid . '">';
    echo '<label for="' . $key . '">' . $label . '</label>';
    echo '<textarea id="' . $key . '" name="' . $key . '" placeholder="' . $placeholder . '"' . $aria . '>' . oldValue($key, $values) . '</textarea>';
    echo fieldError($key, $errors) . '</div>';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Magtolis, Moses Rieve J</title>
    <link rel="stylesheet" href="form.css">
</head>
<body>
<main class="page-shell">
    <header class="page-header">
        <p class="eyebrow">MAGTOLIS RESUME BUILDER</p>
        <h1>Build a resume that moves you forward.</h1>
        <p class="intro">Complete every section below. Your information will be checked securely before your resume is generated.</p>
    </header>

    <?php if ($errors): ?>
        <div class="summary-error" role="alert">Please correct the highlighted fields before continuing.</div>
    <?php endif; ?>

    <form action="index.php" method="POST" novalidate>
        <section class="form-section">
            <div class="section-heading"><span>01</span><div><h2>Personal information</h2><p>How employers can reach and identify you.</p></div></div>
            <div class="field-grid">
                <?php inputField('name', 'Full Name', $values, $errors, 'text', 'e.g. Alex Morgan'); ?>
                <?php inputField('phone', 'Phone', $values, $errors, 'text', 'e.g. +1 555 010 2040'); ?>
                <?php inputField('email', 'Email', $values, $errors, 'email', 'e.g. alex@example.com'); ?>
                <?php inputField('location', 'Location', $values, $errors, 'text', 'e.g. City, State'); ?>
                <?php inputField('linkedin', 'LinkedIn Profile', $values, $errors, 'url', 'https://linkedin.com/in/yourname'); ?>
                <?php inputField('photo', 'Profile Photo URL', $values, $errors, 'url', 'https://example.com/photo.jpg'); ?>
            </div>
        </section>

        <section class="form-section">
            <div class="section-heading"><span>02</span><div><h2>Professional summary</h2><p>Show the value you bring to a future team.</p></div></div>
            <?php textareaField('objective', 'Career Objective', $values, $errors, 'Write a concise career objective...'); ?>
        </section>

        <section class="form-section">
            <div class="section-heading"><span>03</span><div><h2>Skills</h2><p>Highlight your technical and interpersonal strengths.</p></div></div>
            <div class="field-grid">
                <?php textareaField('technical', 'Technical Skills', $values, $errors, 'PHP, MySQL, JavaScript, Excel...'); ?>
                <?php textareaField('soft', 'Soft Skills', $values, $errors, 'Communication, teamwork, problem-solving...'); ?>
            </div>
        </section>

        <section class="form-section">
            <div class="section-heading"><span>04</span><div><h2>Experience</h2><p>Describe your most relevant role and achievements.</p></div></div>
            <div class="field-grid">
                <?php inputField('job_title', 'Job Title', $values, $errors, 'text', 'e.g. Web Developer'); ?>
                <?php inputField('company', 'Company Name', $values, $errors, 'text', 'e.g. Company Name'); ?>
                <?php inputField('start_date', 'Start Date', $values, $errors, 'text', 'e.g. January 2023'); ?>
                <?php inputField('end_date', 'End Date', $values, $errors, 'text', 'e.g. Present'); ?>
                <?php inputField('responsibility1', 'Key Responsibility / Achievement #1', $values, $errors, 'text', 'Describe an achievement'); ?>
                <?php inputField('responsibility2', 'Key Responsibility / Achievement #2', $values, $errors, 'text', 'Describe an achievement'); ?>
                <?php inputField('responsibility3', 'Key Responsibility / Achievement #3', $values, $errors, 'text', 'Describe an achievement'); ?>
            </div>
        </section>

        <section class="form-section">
            <div class="section-heading"><span>05</span><div><h2>Education</h2><p>List your latest academic qualification.</p></div></div>
            <div class="field-grid">
                <?php inputField('degree', 'Degree / Course', $values, $errors, 'text', 'e.g. BSc in Computer Science'); ?>
                <?php inputField('university', 'University / Institute', $values, $errors, 'text', 'e.g. XYZ University'); ?>
                <?php inputField('education_year', 'Education Year', $values, $errors, 'text', 'e.g. 2024'); ?>
                <?php inputField('cgpa', 'CGPA / Grade', $values, $errors, 'text', 'e.g. 8.5/10'); ?>
            </div>
        </section>

        <section class="form-section">
            <div class="section-heading"><span>06</span><div><h2>Certifications and languages</h2><p>Add credentials and communication skills.</p></div></div>
            <div class="field-grid">
                <?php inputField('certification', 'Certification Name', $values, $errors, 'text', 'e.g. AWS Cloud Practitioner'); ?>
                <?php inputField('certification_institute', 'Certification Institute', $values, $errors, 'text', 'e.g. Amazon Web Services'); ?>
                <?php inputField('certification_year', 'Certification Year', $values, $errors, 'text', 'e.g. 2025'); ?>
                <?php textareaField('languages', 'Languages', $values, $errors, 'English (Fluent) / Hindi (Fluent)'); ?>
            </div>
        </section>

        <section class="form-section">
            <div class="section-heading"><span>07</span><div><h2>Projects and internships</h2><p>Give your practical work a clear place on the page.</p></div></div>
            <div class="field-grid">
                <?php inputField('project_title', 'Project / Internship Title', $values, $errors, 'text', 'e.g. Inventory Management System'); ?>
                <?php inputField('project_company', 'Project Company / Institute', $values, $errors, 'text', 'e.g. ABC Technologies'); ?>
                <?php textareaField('project_description', 'Project Description', $values, $errors, 'Briefly describe the work completed...'); ?>
                <?php inputField('tools', 'Tools / Technologies Used', $values, $errors, 'text', 'e.g. PHP, MySQL, HTML, CSS'); ?>
            </div>
        </section>

        <div class="form-actions"><p>All fields must be completed.</p><button type="submit">Generate my resume <span aria-hidden="true">&#8594;</span></button></div>
    </form>
</main>
</body>
</html>
