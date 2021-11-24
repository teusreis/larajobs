let exNumber = document.querySelectorAll(".experience-container").length;
const exContainer = document.querySelector(".main-container");
let exArray = exContainer.querySelectorAll(".experience-container");
const deleteExBtn = document.querySelector("#deleteExBtn");
const newExBtn = document.querySelector("#newExBtn");
const exMessage = document.querySelector("#exMessage");

canAddEx();
canDeleteEx();

newExBtn.addEventListener("click", (event) => {
    if (exNumber >= 5) {
        alert("You cannot add a new ex!");
        return;
    }

    const html = renderTemplate();
    exContainer.appendChild(html);
    exArray = exContainer.querySelectorAll(".experience-container");

    canAddEx();
    canDeleteEx();

    window.scrollTo({
        top: window.outerHeight * 1000,
        left: 100,
        behavior: "smooth",
    });
});

deleteExBtn.addEventListener("click", () => {
    if (exArray.length === 0) {
        return;
    }
    exContainer.removeChild(exArray[exArray.length - 1]);
    exNumber--;
    exArray = exContainer.querySelectorAll(".experience-container");

    canDeleteEx();
    canAddEx();
});

function renderTemplate() {
    const template = `
        <div class="mb-4 experience-container grid gap-5 md:grid-cols-2">
            <h4 class="text-lg border-b col-span-full">Experience #${
                exNumber + 1
            }</h4>

            <div class="md:md:col-span-1">
                <label for="name_${exNumber}" class="font-semibold">Company</label>
                <input type="text" name="company_name[]" id="name_${exNumber}" class="w-full rounded">
            </div>

            <div class="md:md:col-span-1">
                <label for="position_${exNumber}" class="font-semibold">Position</label>
                <input type="text" name="position[]" id="position_${exNumber}" class="w-full rounded">
            </div>

            <div class="md:col-span-1>
                <label for="start_${exNumber}" class="font-semibold">Start</label>
                <input type="date" name="start[]" id="start_${exNumber}" class="w-full rounded">
            </div>

            <div class="md:col-span-1">
                <label for="end_${exNumber}" class="font-semibold">End</label>
                <input type="date" name="end[]" id="end_${exNumber}" class="w-full rounded">
            </div>

            <div class="md:col-span-full">
                <label for="job_description_${exNumber}" class="font-semibold">Description</label>
                <textarea class="rounded w-full" name="job_description[]" id="job_description_${exNumber}" cols="30" rows="10"></textarea>
            </div>
        </div>
    `;

    exNumber++;
    return document.createRange().createContextualFragment(template);
}

function canAddEx() {
    if (exNumber >= 5) {
        newExBtn.classList.add("hidden");
    } else {
        newExBtn.classList.remove("hidden");
    }
}

function canDeleteEx() {
    if (exNumber === 0) {
        deleteExBtn.classList.add("hidden");
        exMessage.classList.remove("hidden");
    } else {
        deleteExBtn.classList.remove("hidden");
        exMessage.classList.add("hidden");
    }
}

// Education variables
let edNumber = document.querySelectorAll('.education-container').length;
const edContainer = document.querySelector('.education-main-container');
let edArray = edContainer.querySelectorAll('.education-container');
const deleteEdBtn = document.querySelector('#deleteEdBtn');
const addEdBtn = document.querySelector('#addEdBtn');
const edMessage = document.querySelector('#edMessage');

canAddEd();
canDeleteEd();

addEdBtn.addEventListener('click', (event) => {
    if (edNumber >= 5) {
        alert("You can not add more education info!");
        return;
    }

    let html = renderEducationTemplate();

    edContainer.appendChild(html);
    edArray = edContainer.querySelectorAll('.education-container');

    canAddEd();
    canDeleteEd();
});

deleteEdBtn.addEventListener('click', () => {
    if (edNumber === 0) {
        return;
    }

    edContainer.removeChild(edArray[edArray.length - 1]);
    edNumber--;
    edArray = edContainer.querySelectorAll('.education-container');

    canAddEd();
    canDeleteEd();
});

function renderEducationTemplate() {
    let template = `
    <div class="mb-4 education-container grid gap-5 md:grid-cols-2" x-data="{ stillCoursing: false }" >

        <h4 class="text-lg border-b col-span-full">Education #${edNumber + 1}</h4>

        <div class="col-span-2">
            <label for="level${edNumber}" class="font-semibold">Level</label>
            <select name="level[]" id="level${edNumber}" class="w-full rounded">
                <option value="1">High school</option>
                <option value="2">Bachelor degree</option>
                <option value="3">College</option>
                <option value="4">Master's degree</option>
                <option value="5">PHD</option>
            </select>
        </div>

        <div class="md:col-span-1">
            <label for="course_name${edNumber}" class="font-semibold">Course name</label>
            <input type="text" name="course_name[]" id="course_name${edNumber}"
                class="w-full rounded" value="">
        </div>

        <div class="md:col-span-1">
            <label for="institution_name${edNumber}" class="font-semibold">Institution
                name</label>
            <input type="text" name="institution_name[]" id="institution_name${edNumber}"
                class="w-full rounded" value="">
        </div>

        <div class="col-span-2 flex items-center">
            <input type="checkbox" x-model="stillCoursing" name="stillCoursing[]"
                id="stillCoursing${edNumber}" class="rounded mr-3">
            <label for="stillCoursing${edNumber}">Still coursing</label>
        </div>

        <div class="md:col-span-1">
            <label for="start_date${edNumber}" class="font-semibold">Start date</label>
            <input type="date" name="start_date[]" id="start_date${edNumber}"
                class="w-full rounded" value="">
        </div>

        <div class="md:col-span-1">
            <label for="end_date${edNumber}" class="font-semibold">End date</label>
            <input type="date" name="end_date[]" id="end_date${edNumber}"
                class="w-full rounded" value="" :readonly="stillCoursing">
        </div>

    </div>
    `;

    edNumber++;
    return document.createRange().createContextualFragment(template);
}

function canAddEd() {
    if (edNumber >= 5) {
        addEdBtn.classList.add('hidden');
    } else {
        addEdBtn.classList.remove('hidden');
    }
}

function canDeleteEd() {
    if (edNumber === 0) {
        deleteEdBtn.classList.add('hidden');
        edMessage.classList.remove('hidden');
    } else {
        deleteEdBtn.classList.remove('hidden');
        edMessage.classList.add('hidden');
    }
}

//Alpine js script for the skill section
function skillData() {
    return {
        newSkill: "",
        skills: skills || [],
        inputSkills: skills.join(";") || "",
        addSkill() {
            if (this.newSkill === "") return;

            if (this.skills.includes(this.newSkill)) {
                alert("You alredy added this skill!");
                this.newSkill = "";
                return;
            }

            this.skills.push(this.newSkill);
            this.newSkill = "";
            this.inputSkills = this.skills.join(";");
        },
        removeSkill(index) {
            this.skills.splice(index, 1);
            this.inputSkills = this.skills.join(";");
        },
    };
}
