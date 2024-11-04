<?php
include "connection.php";
$query = 'SELECT * FROM component_table';
$data = mysqli_query($con, $query);

$components = []; // Array to hold all components

if (mysqli_num_rows($data) > 0) {
    while ($component = mysqli_fetch_assoc($data)) {
        $htmlCode = htmlspecialchars($component['html_code'], ENT_QUOTES);
        $cssCode = htmlspecialchars($component['css_code'], ENT_QUOTES);
        $uploader = htmlspecialchars($component['email'], ENT_QUOTES);

        $components[] = ['html' => $htmlCode, 'css' => $cssCode, 'uploader' => $uploader];
    }
} else {
    echo "<p>No components found.</p>";
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InstantUI | Components</title>
    <link rel="stylesheet" href="./style/components.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dompurify/2.3.5/purify.min.js"></script> <!-- Include DOMPurify -->
</head>

<body>
    <?php include "navbar.php"; ?>

    <div class="box">
        <div class="sidebar">
            <li><i class="fa-solid fa-book-open"></i> <span>All</span></li>
            <li><i class="fas fa-play-circle"></i><span>Buttons</span></li>
            <li><i class="fa-solid fa-square-check"></i><span>Checkbox</span></li>
            <li><i class="fa-solid fa-file"></i><span>Card</span></li>
            <li><i class="fa-solid fa-spinner"></i><span>Loaders</span></li>
            <li><i class="fa-solid fa-print"></i><span>Inputs</span></li>
            <li><i class="fa-solid fa-circle-dot"></i><span>Radio buttons</span></li>
            <li><i class="fa-solid fa-clipboard-list"></i><span>Forms</span></li>
            <li><i class="fa-solid fa-circle-question"></i><span>Tooltips</span></li>
        </div>
        <div class="middle">
            <div class="header">
                <h2>Browse all</h2>
                <p>Open-Source UI elements made with CSS or Tailwind</p>
            </div>
            <div class="elements">
                <?php foreach ($components as $component): ?>
                    <div class="card">
                        <div class="element">
                            <div class="rendered-html"></div> <!-- Placeholder for rendered HTML -->
                        </div>
                        <div class="name"><?php echo $component['uploader']; ?></div>
                        <div class="button" onclick="alert('Code Snippet:\n\n<?= $component['html'] ?>')">
                            <i class="fa-solid fa-code"></i> Get Code
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <script>
        const components = <?= json_encode($components) ?>;

        document.querySelectorAll('.card').forEach((card, index) => {
            const componentData = components[index];

            // Create a new div element for the HTML
            const htmlElement = document.createElement("div");
            console.log(componentData.html);
            const sanitizedHTML = DOMPurify.sanitize(componentData.html);
            console.log(sanitizedHTML);
            htmlElement.innerHTML = sanitizedHTML;

            // Create a new style element for the CSS
            const styleElement = document.createElement("style");
            styleElement.textContent = componentData.css;

            // Append the style and HTML elements to the card's .rendered-html div
            card.querySelector('.rendered-html').appendChild(styleElement);
            card.querySelector('.rendered-html').appendChild(htmlElement);
        });
    </script>

    <script src="https://kit.fontawesome.com/0a16c6e09c.js" crossorigin="anonymous"></script>
</body>

</html>