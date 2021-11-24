function requiredSkillsData() {
    return {
        newSkill: "",
        skills: typeof requiredSkills != "undefined" ? requiredSkills : [],
        inputSkills:
            typeof requiredSkills != "undefined"
                ? requiredSkills.join(";")
                : "",
        addSkill() {
            if (this.newSkill === "") return;

            if (this.skills.includes(this.newSkill)) {
                alert("You alredy added this skill!");
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

function optionalSkillsData() {
    return {
        newSkill: "",
        skills: typeof optionalSkills != "undefined" ? optionalSkills : [],
        inputSkills:
            typeof optionalSkills != "undefined"
                ? optionalSkills.join(";")
                : "",
        addSkill() {
            if (this.newSkill === "") return;

            if (this.skills.includes(this.newSkill)) {
                alert("You alredy added this skill!");
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

function formData() {
    return {
        isRemote: false,
    };
}
