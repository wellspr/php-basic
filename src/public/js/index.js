const { createApp, ref } = Vue;

homePage = createApp({
    data() {
        return {
            heading: "Homepage",
            message: "Hello new Vue!",
            label: "Click to increase!",
        };
    },
    setup() {
        const count = ref(0);

        function increment() {
            count.value++;
        }

        return {
            count,
            increment,
        };
    }
});

aboutPage = createApp({
    data() {
        return {
            heading: "About",
        };
    }
});

postsPage = createApp({
    data() {
        return {
            heading: "Posts",
        };
    }
});


switch(location.pathname) {
    case "/":
        homePage.mount("#homePage");
        break;
    case "/about":
        aboutPage.mount("#aboutPage");
        break;
    case "/posts":
        postsPage.mount("#postsPage");
        break;
    default:
        console.log("Nothing to mount.");
}


/*
let path = location.pathname;
console.log(path, window);

addEventListener("load", () => {
    fetch(`/api`)
        .then(r => r.text())
        .then(data => {
            console.log(data);
        });
});


updatedCount = function(count) {
    //https://developer.mozilla.org/en-US/docs/Web/API/CustomEvent/CustomEvent
    //https://blog.logrocket.com/custom-events-in-javascript-a-complete-guide/
    return new CustomEvent("countUpdate", {
        detail: {
            name: "count",
            count: count,
        }
    });
};

class Count {
    constructor(count) {
        this.count = count;
    }

    increase() {
        this.count += 1;
        dispatchEvent(updatedCount(this.count));
    }

    decrease() {
        this.count -= 1;
        dispatchEvent(updatedCount(this.count));
    }

    getValue() {
        return this.count;
    }
}

class El {
    constructor(id) {
        this.el = document.getElementById(id);
    }

    setInnerHTML(value) {
        this.el.innerHTML = value;
    }

    update(value) {
        this.el.innerHTML = value;
    }
}

const count = new Count(0);
const result = new El("result")

if (result.el) {
    result.setInnerHTML(0);

    window.addEventListener("countUpdate", e => result.update(e.detail.count));
    document.getElementById("counter-button").addEventListener("click", () => count.increase());
}

*/