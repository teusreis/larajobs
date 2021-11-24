<div {{ $attributes->merge(['class' => 'grid lg:grid-cols-2 gap-3 lg:px-auto bg-white p-5 rounded']) }}>
    @csrf
    <div class="lg:col-span-1">
        <label for="title" class="block">Title</label>
        <x-form.input type="text" name="title" id="title" value="{{ old('title') ?? ($job->title ?? '') }}" />
        @error('title')
            {{ $message }}
        @enderror
    </div>

    <div class="lg:col-span-1">
        <label for="salary" class="block">Salary</label>

        <x-form.select name="salary" id="salary">
            <option value="0" @if (old('salary') == 0 || $job->salary == 0) selected @endif>
                0 to $1.000,00
            </option>
            <option value="1" @if (old('salary') == 1 || (isset($job) && $job->salary == 1)) selected @endif>
                $1.000,00 to $2.000,00
            </option>
            <option value="2" @if (old('salary') == 2 || (isset($job) && $job->salary == 2)) selected @endif>
                $2.000,01 to $3.000,00
            </option>
            <option value="3" @if (old('salary') == 3 || (isset($job) && $job->salary == 3)) selected @endif>
                $3.000,01 to $5.000,00
            </option>
            <option value="4" @if (old('salary') == 4 || (isset($job) && $job->salary == 4)) selected @endif>
                $5.000,01 to $10.000,00
            </option>
            <option value="5" @if (old('salary') == 5 || (isset($job) && $job->salary == 5)) selected @endif>
                $10.000,00 or more!
            </option>
        </x-form.select>
        @error('salary')
            {{ $message }}
        @enderror
    </div>

    <div class="col-span-2">
        <input type="checkbox" name="isRemote" id="isRemote" x-model="isRemote" class="rounded">
        <label for="isRemote">Is Remote</label>
        @error('isRemote')
            {{ $message }}
        @enderror
    </div>

    <div x-show="!isRemote">
        <label for="state">State</label>
        <x-form.input type="text" name="state" id="state" value="{{ old('state') ?? ($job->state ?? '') }}" />
        @error('state')
            {{ $message }}
        @enderror
    </div>

    <div x-show="!isRemote">
        <label for="address">Address</label>
        <x-form.input type="text" name="address" id="address" value="{{ old('address') ?? ($job->address ?? '') }}" />
        @error('address')
            {{ $message }}
        @enderror
    </div>

    <div class="lg:col-span-2">
        <label for="description" class="block">Job Description</label>
        <x-form.textarea name="description" id="description" cols="30" rows="10" class="w-full rounded">
            {{ old('description') ?? ($job->description ?? '') }}</x-form.textarea>
        @error('description')
            {{ $message }}
        @enderror
    </div>

    <div class="lg:col-span-1" x-data="requiredSkillsData()">
        <label for="required_skills" class="block">Required skills</label>

        <div class="flex">
            <x-form.input name="required_skills" class="mb-0 mt-0" x-model="newSkill" type="text"
                id="required_skills" />

            <button x-on:click="addSkill();"
                class="p-3 bg-gray-600 hover:bg-gray-700 transition-all text-white rounded-r border-l-0" type="button"
                id="addSkill">
                Add
            </button>
            <input type="hidden" name="required_skills" id="" x-model="inputSkills">
        </div>
        <ul x-show="skills.length > 0" class="py-3">
            <template x-for="(skill, index) in skills" :key="index">
                <li x-text="skill" class="px-3 py-2 bg-purple-400 font-semibold mx-1 mb-2 rounded-lg inline-block"
                    x-on:click="removeSkill(index)"></li>
            </template>
        </ul>
        @error('required_skills')
            {{ $message }}
        @enderror
    </div>

    <div class="lg:col-span-1" x-data="optionalSkillsData()">
        <label for="optional_skills" class="block">Optional skills</label>

        <div class="flex">
            <x-form.input name="newSkill" x-model="newSkill" class="mb-0 mt-0" type="text" id="optional_skills" />

            <button x-on:click="addSkill();"
                class="p-3 bg-gray-600 hover:bg-gray-700 transition-all text-white rounded-r border-l-0" type="button"
                id="addSkill">
                Add
            </button>
            <input type="hidden" name="optional_skills" id="" x-model="inputSkills">
        </div>
        <ul x-show="skills.length > 0" class="py-3">
            <template x-for="(skill, index) in skills" :key="index">
                <li x-text="skill" class="px-3 py-2 bg-purple-400 font-semibold inline-block mx-1 mb-2 rounded-lg"
                    x-on:click="removeSkill(index)"></li>
            </template>
        </ul>
        @error('optional_skills')
            {{ $message }}
        @enderror
    </div>

    <div class="lg:col-span-2">
        <x-ui.button type="submit">
            Submit
        </x-ui.button>
    </div>
</div>
