<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InstantUI | Element</title>
    <link rel="stylesheet" href="./style/components.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.25.0/themes/prism.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.25.0/prism.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.25.0/plugins/line-numbers/prism-line-numbers.js"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.25.0/plugins/line-numbers/prism-line-numbers.css">

</head>

<body>
    <?php include "navbar.php" ?>

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
            <button class="back"><i class="fa-solid fa-arrow-left"></i>Go back</button>
            <div class="container">
                <div class="left-part" id="preview">
                </div>
                <div class="right-part">
                    <div class="top">
                        <ul>
                            <li class="active" data-lang="html">HTML</li>
                            <li data-lang="css">CSS</li>
                            <li data-lang="js">JS</li>
                        </ul>
                    </div>
                    <div class="content">
                        <pre class="line-numbers" id="html-code">
                            <code class="language-html"></code>
                        </pre>
                        <pre class="line-numbers" id="css-code" style="display: none;">
                            <code class="language-css"></code>
                        </pre>
                        <pre class="line-numbers" id="js-code" style="display: none;">
                            <code class="language-javascript"></code>
                        </pre>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const codeSnippets = {
            html: `
<div class="cookie-card">
    <span class="title">🍪 Cookie Notice</span>
    <p class="description">We use cookies to ensure that we give you the best experience on our website. <a href="#">Read cookies policies</a>. </p>
    <div class="actions">
        <button class="pref">
            Manage your preferences
        </button>
        <button class="accept">
            Accept
        </button>
    </div>
</div>`,
            css: `/* From Uiverse.io by Yaya12085 */ 
.cookie-card {
  max-width: 320px;
  padding: 1rem;
  background-color: #fff;
  border-radius: 10px;
  box-shadow: 20px 20px 30px rgba(0, 0, 0, .05);
}

.title {
  font-weight: 600;
  color: rgb(31 41 55);
}

.description {
  margin-top: 1rem;
  font-size: 0.875rem;
  line-height: 1.25rem;
  color: rgb(75 85 99);
}

.description a {
  --tw-text-opacity: 1;
  color: rgb(59 130 246);
}

.description a:hover {
  -webkit-text-decoration-line: underline;
  text-decoration-line: underline;
}

.actions {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-top: 1rem;
  -moz-column-gap: 1rem;
  column-gap: 1rem;
  flex-shrink: 0;
}

.pref {
  font-size: 0.75rem;
  line-height: 1rem;
  color: rgb(31 41 55 );
  -webkit-text-decoration-line: underline;
  text-decoration-line: underline;
  transition: all .3s cubic-bezier(0.4, 0, 0.2, 1);
  border: none;
  background-color: transparent;
}

.pref:hover {
  color: rgb(156 163 175);
}

.pref:focus {
  outline: 2px solid transparent;
  outline-offset: 2px;
}

.accept {
  font-size: 0.75rem;
  line-height: 1rem;
  background-color: rgb(17 24 39);
  font-weight: 500;
  border-radius: 0.5rem;
  color: #fff;
  padding-left: 1rem;
  padding-right: 1rem;
  padding-top: 0.625rem;
  padding-bottom: 0.625rem;
  border: none;
  transition: all .15s cubic-bezier(0.4, 0, 0.2, 1);
}

.accept:hover {
  background-color: rgb(55 65 81);
}

.accept:focus {
  outline: 2px solid transparent;
  outline-offset: 2px;
}`,
            js: `console.log("This is a JavaScript snippet!");`
        };

        const htmlCodeBlock = document.querySelector("#html-code code.language-html");
        const cssCodeBlock = document.querySelector("#css-code code.language-css");
        const jsCodeBlock = document.querySelector("#js-code code.language-javascript");
        htmlCodeBlock.textContent = codeSnippets.html;

        Prism.highlightAll();

        function updatePreview() {
            const previewArea = document.getElementById("preview");
            previewArea.innerHTML = "";

            const htmlElement = document.createElement("div");
            htmlElement.innerHTML = codeSnippets.html;

            const styleElement = document.createElement("style");
            styleElement.textContent = codeSnippets.css;

            previewArea.appendChild(styleElement);
            previewArea.appendChild(htmlElement);
        }

        // Set initial preview
        updatePreview();

        // Tab click event
        document.querySelectorAll(".top li").forEach((tab) => {
            tab.addEventListener("click", () => {
                // Remove active class from all tabs
                document.querySelector(".top li.active").classList.remove("active");
                // Add active class to the clicked tab
                tab.classList.add("active");

                // Hide all code blocks and show the selected one
                document.querySelectorAll(".content pre").forEach((pre) => (pre.style.display = "none"));
                const lang = tab.getAttribute("data-lang");
                document.querySelector(`#${lang}-code`).style.display = "block";

                // Set the content of the selected code block
                if (lang === "html") {
                    htmlCodeBlock.textContent = codeSnippets.html;
                    updatePreview(); // Update preview for HTML
                } else if (lang === "css") {
                    cssCodeBlock.textContent = codeSnippets.css;
                    updatePreview(); // Update preview for CSS
                } else if (lang === "js") {
                    jsCodeBlock.textContent = codeSnippets.js;
                    // For JS, you can run the script if necessary
                    eval(codeSnippets.js); // Caution: eval can be dangerous, use with care
                }

                Prism.highlightAll();
            });
        });
    </script>
    <script src="https://kit.fontawesome.com/0a16c6e09c.js" crossorigin="anonymous"></script>
</body>

</html>