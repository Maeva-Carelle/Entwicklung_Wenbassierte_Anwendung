async function requestData() {
    try {
        const response = await fetch("api");

        if (!response.ok) {
            throw new Error(`Fehler: ${response.status}`);
        }

        const data = await response.json();
        process(data);
    } catch (error) {
        console.error("Übertragung fehlgeschlagen:", error);
    }
}

function process(data) {
    const statusElements = document.querySelectorAll("[data-ordered-article-id]");

    data.forEach(article => {
        const element = document.querySelector(
            `[data-ordered-article-id="${article.ordered_article_id}"]`
        );

        if (!element) {
            return;
        }

        const status = parseInt(article.status);

        const statusMap = {
            0: "Bestellt",
            1: "In Vorbereitung",
            2: "Fertig",
            3: "Unterwegs"
        };

        element.textContent = statusMap[status] ?? "Unbekannt";

        element.className = "status-badge";

        if (status === 0) {
            element.classList.add("status-ordered");
        } else if (status === 1) {
            element.classList.add("status-preparing");
        } else if (status === 2) {
            element.classList.add("status-ready");
        } else if (status === 3) {
            element.classList.add("status-delivery");
        }
    });
}

document.addEventListener("DOMContentLoaded", () => {
    requestData();
    setInterval(requestData, 2000);
});