<?php

function getValue($key, $default = "")
{
    $source = $_POST[$key] ?? $_GET[$key] ?? $default;

    return htmlspecialchars(
        is_string($source) ? $source : $default,
        ENT_QUOTES,
        'UTF-8'
    );
}

$name = getValue('name', 'YOUR FULL NAME');

$phone = getValue('phone');
$email = getValue('email');
$location = getValue('location');
$linkedin = getValue('linkedin');
$photo = getValue('photo');

$objective = getValue('objective');

$technical = getValue('technical');
$soft = getValue('soft');

$jobTitle = getValue('job_title');
$company = getValue('company');
$startDate = getValue('start_date');
$endDate = getValue('end_date');

$responsibility1 = getValue('responsibility1');
$responsibility2 = getValue('responsibility2');
$responsibility3 = getValue('responsibility3');

$degree = getValue('degree');
$university = getValue('university');
$educationYear = getValue('education_year');
$cgpa = getValue('cgpa');

$certification = getValue('certification');
$certInstitute = getValue('certification_institute');
$certYear = getValue('certification_year');

$languages = getValue('languages');

$projectTitle = getValue('project_title');
$projectCompany = getValue('project_company');
$projectDescription = getValue('project_description');
$tools = getValue('tools');

$hasExperience =
    !empty($jobTitle) ||
    !empty($company) ||
    !empty($responsibility1) ||
    !empty($responsibility2) ||
    !empty($responsibility3);

$hasCertification =
    !empty($certification) ||
    !empty($certInstitute) ||
    !empty($certYear);

$hasProject =
    !empty($projectTitle) ||
    !empty($projectCompany) ||
    !empty($projectDescription) ||
    !empty($tools);

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title><?php echo $name; ?> - Resume</title>

    <link rel="stylesheet" href="resume.css">

</head>

<body>
<div class="resume">

    <div class="top">

        <h1>
            <?php echo $name; ?>
        </h1>

        <div class="photo">

            <?php if (!empty($photo)): ?>

                <img
                    src="<?php echo $photo; ?>"
                    alt="Profile Photo"
                >

            <?php else: ?>

                <div class="default-person">

                    <div class="default-head"></div>

                    <div class="default-body"></div>

                </div>

            <?php endif; ?>

        </div>

    </div>


    <div class="main">

        <aside class="sidebar">

            <div class="sidebar-section">

                <div class="sidebar-title">
                    CONTACT
                </div>

                <?php if (!empty($phone)): ?>

                    <div class="contact-item">
                        <span class="contact-icon">☎</span>

                        <?php echo $phone; ?>
                    </div>

                <?php endif; ?>


                <?php if (!empty($email)): ?>

                    <div class="contact-item">
                        <span class="contact-icon">✉</span>

                        <?php echo $email; ?>
                    </div>

                <?php endif; ?>


                <?php if (!empty($location)): ?>

                    <div class="contact-item">
                        <span class="contact-icon">●</span>

                        <?php echo $location; ?>
                    </div>

                <?php endif; ?>


                <?php if (!empty($linkedin)): ?>

                    <div class="contact-item">
                        <span class="contact-icon">in</span>

                        <?php echo $linkedin; ?>
                    </div>

                <?php endif; ?>

            </div>


            <?php if ($hasCertification): ?>

                <div class="sidebar-section">

                    <div class="sidebar-title">
                        CERTIFICATIONS
                    </div>

                    <?php if (!empty($certification)): ?>

                        <strong>
                            <?php echo $certification; ?>
                        </strong>

                    <?php endif; ?>

                    <?php if (
                        !empty($certInstitute) ||
                        !empty($certYear)
                    ): ?>

                        <ul>

                            <li>

                                <?php echo $certInstitute; ?>

                                <?php if (!empty($certYear)): ?>

                                    [<?php echo $certYear; ?>]

                                <?php endif; ?>

                            </li>

                        </ul>

                    <?php endif; ?>

                </div>

            <?php endif; ?>


            <?php if (!empty($languages)): ?>

                <div class="sidebar-section">

                    <div class="sidebar-title">
                        LANGUAGES
                    </div>

                    <ul>

                        <?php

                        $languageList = preg_split(
                            "/\r\n|\r|\n/",
                            $languages
                        );

                        foreach ($languageList as $language):

                            if (trim($language) !== ""):

                        ?>

                            <li>
                                <?php
                                echo htmlspecialchars(
                                    trim($language),
                                    ENT_QUOTES,
                                    'UTF-8'
                                );
                                ?>
                            </li>

                        <?php

                            endif;

                        endforeach;

                        ?>

                    </ul>

                </div>

            <?php endif; ?>

        </aside>


        <main class="content">

            <!-- CAREER OBJECTIVE -->

            <section class="content-section">

                <div class="section-icon">
                    ●
                </div>

                <div class="content-title">
                    CAREER OBJECTIVE
                </div>

                <div class="objective">
                    <?php echo nl2br($objective); ?>
                </div>

            </section>


            <!-- KEY SKILLS -->

            <section class="content-section">

                <div class="section-icon">
                    ★
                </div>

                <div class="content-title">
                    KEY SKILLS
                </div>

                <ul class="skills">

                    <?php if (!empty($technical)): ?>

                        <li>

                            <strong>
                                Technical:
                            </strong>

                            <?php echo nl2br($technical); ?>

                        </li>

                    <?php endif; ?>


                    <?php if (!empty($soft)): ?>

                        <li>

                            <strong>
                                Soft Skills:
                            </strong>

                            <?php echo nl2br($soft); ?>

                        </li>

                    <?php endif; ?>

                </ul>

            </section>


            <!-- EXPERIENCE -->

            <?php if ($hasExperience): ?>

                <section class="content-section">

                    <div class="section-icon">
                        ●
                    </div>

                    <div class="content-title">
                        EXPERIENCE
                    </div>

                    <div class="experience-title">

                        <?php echo $jobTitle; ?>

                        <?php if (!empty($company)): ?>

                            -
                            <?php echo $company; ?>

                        <?php endif; ?>

                        <?php if (
                            !empty($startDate) ||
                            !empty($endDate)
                        ): ?>

                            [

                            <?php echo $startDate; ?>

                            -

                            <?php echo $endDate; ?>

                            ]

                        <?php endif; ?>

                    </div>

                    <ul>

                        <?php if (!empty($responsibility1)): ?>

                            <li>
                                <?php echo $responsibility1; ?>
                            </li>

                        <?php endif; ?>


                        <?php if (!empty($responsibility2)): ?>

                            <li>
                                <?php echo $responsibility2; ?>
                            </li>

                        <?php endif; ?>


                        <?php if (!empty($responsibility3)): ?>

                            <li>
                                <?php echo $responsibility3; ?>
                            </li>

                        <?php endif; ?>

                    </ul>

                </section>

            <?php endif; ?>


            <!-- EDUCATION -->

            <section class="content-section">

                <div class="section-icon">
                    🎓
                </div>

                <div class="content-title">
                    EDUCATION
                </div>

                <div class="education-item">

                    • <?php echo $degree; ?>

                    |

                    <?php echo $university; ?>

                    |

                    <?php echo $educationYear; ?>

                </div>


                <?php if (!empty($cgpa)): ?>

                    <div class="education-item">

                        • CGPA:
                        <?php echo $cgpa; ?>

                    </div>

                <?php endif; ?>

            </section>


            <!-- PROJECTS / INTERNSHIPS -->

            <?php if ($hasProject): ?>

                <section class="content-section">

                    <div class="section-icon">
                        🎓
                    </div>

                    <div class="content-title">
                        PROJECTS / INTERNSHIPS
                    </div>


                    <?php if (!empty($projectTitle)): ?>

                        <div class="experience-title">

                            <?php echo $projectTitle; ?>

                            <?php if (!empty($projectCompany)): ?>

                                -
                                <?php echo $projectCompany; ?>

                            <?php endif; ?>

                        </div>

                    <?php endif; ?>


                    <?php if (!empty($projectDescription)): ?>

                        <div class="project-description">

                            <?php
                            echo nl2br($projectDescription);
                            ?>

                        </div>

                    <?php endif; ?>


                    <?php if (!empty($tools)): ?>

                        <div class="tools">

                            <strong>
                                Tools/technologies used:
                            </strong>

                            <?php echo $tools; ?>

                        </div>

                    <?php endif; ?>

                </section>

            <?php endif; ?>

        </main>

    </div>

    <div class="footer">
        Moses Rieve J Magtolis
    </div>

</div>


<button
    class="print-button"
    onclick="window.print()"
>
    Print / Save PDF
</button>

</body>
</html>
