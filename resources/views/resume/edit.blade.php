@extends('layouts.main')

@section('content')
    <main>
        <form action="{{ route('resume.update', $resume->id) }}" method="post" class="max-w-2xl mx-auto grid gap-5 pt-3">
            @csrf
            @method('PUT')

            <div>
                <label class="font-semibold" for="title">Title</label>
                <input type="text" name="title" id="title" class="rounded w-full"
                    value="{{ old('title') ?? ($resume->title ?? '') }}">

                @error('title')
                    {{ $message }}
                @enderror
            </div>

            <div>
                <label class="font-semibold" for="description">Description</label>
                <textarea class="w-full rounded" name="description" id="description" cols="30"
                    rows="10">{{ old('description') ?? ($resume->description ?? '') }}</textarea>
                @error('description')
                    {{ $message }}
                @enderror
            </div>

            <div x-data="skillData()">
                <label class="font-semibold" for="newSkill">Skills</label>
                <div class="flex">
                    <input type="text" name="newSkill" id="newSkill" class="rounded-l border-0-r w-full" x-model="newSkill">
                    <button type="button" x-on:click="addSkill" class="rounded-r text-white bg-gray-700 p-3 border-0-l">
                        Add
                    </button>

                    <input type="hidden" name="skills" x-model="inputSkills">
                </div>
                @error('skills')
                    {{ $message }}
                @enderror
                <div x-show="skills.length >= 1">
                    <ul class="py-3">
                        <template x-for="(skill, index) in skills" :key="index">
                            <li x-text="skill"
                                class="inline-block px-3 py-2 bg-purple-500 hover:bg-purple-600 transition-all rounded text-white font-semibold"
                                x-on:click="removeSkill(index)"></li>
                        </template>
                    </ul>
                </div>
            </div>

            <div>
                <h3 class="font-semibold text-xl border-b mb-5">Experiences</h3>

                <div class="main-container">

                    @if (old('company_name') !== null)

                        @for ($i = 0; $i < count(old('company_name')); $i++)
                            @php
                                $index = $i + 1;
                            @endphp

                            <div class="mb-4 experience-container grid gap-5 md:grid-cols-2">

                                <h4 class="text-lg border-b col-span-full">Experience #{{ $index }}</h4>

                                <div class="md:md:col-span-1">
                                    <label for="name{{ $index }}" class="font-semibold">Company</label>
                                    <input type="text" name="company_name[]" id="name{{ $index }}"
                                        class="w-full rounded" value="{{ old('company_name.' . $i) }}">
                                    @error('company_name.' . $i)
                                        {{ $errors->first('company_name.' . $i) }}
                                    @enderror
                                </div>

                                <div class="md:md:col-span-1">
                                    <label for="position{{ $index }}" class="font-semibold">Position</label>
                                    <input type="text" name="position[]" id="position{{ $index }}"
                                        class="w-full rounded" value="{{ old('position.' . $i) }}">
                                    @error('position.' . $i)
                                        {{ $errors->first('position.' . $i) }}
                                    @enderror
                                </div>

                                <div class="md:col-span-1">
                                    <label for="start{{ $index }}" class="font-semibold">Start</label>
                                    <input type="date" name="start[]" id="start{{ $index }}" class="w-full rounded"
                                        value="{{ old('start.' . $i) }}">
                                    @error('start.' . $i)
                                        {{ $errors->first('start.' . $i) }}
                                    @enderror
                                </div>

                                <div class="md:col-span-1">
                                    <label for="end{{ $index }}" class="font-semibold">End</label>
                                    <input type="date" name="end[]" id="end{{ $index }}" class="w-full rounded"
                                        value="{{ old('end.' . $i) }}">
                                    @error('end.' . $i)
                                        {{ $errors->first('end.' . $i) }}
                                    @enderror
                                </div>

                                <div class="md:col-span-full">
                                    <label for="job_description{{ $index }}"
                                        class="font-semibold">Description</label>
                                    <textarea class="rounded w-full" name="job_description[]"
                                        id="job_description{{ $index }}" cols="30"
                                        rows="10">{{ old('job_description.' . $i) }}</textarea>
                                    @error('job_description.' . $i)
                                        {{ $errors->first('job_description.' . $i) }}
                                    @enderror
                                </div>
                            </div>

                        @endfor

                        <div id="exMessage" class="font-semibold mb-3">
                            <p>No Experience added yet!</p>
                        </div>

                    @elseif ($resume->experience)

                        @foreach ($resume->experience as $i => $ex)
                            @php
                                $index = $i + 1;
                            @endphp

                            <div class="mb-4 experience-container grid gap-5 md:grid-cols-2">

                                <h4 class="text-lg border-b col-span-full">Experience #{{ $index }}</h4>

                                <div class="md:md:col-span-1">
                                    <label for="name{{ $index }}" class="font-semibold">Company</label>
                                    <input type="text" name="company_name[]" id="name{{ $index }}"
                                        class="w-full rounded" value="{{ $ex->company_name }}">
                                </div>

                                <div class="md:md:col-span-1">
                                    <label for="position{{ $index }}" class="font-semibold">Position</label>
                                    <input type="text" name="position[]" id="position{{ $index }}"
                                        class="w-full rounded" value="{{ $ex->position }}">
                                </div>

                                <div class="md:col-span-1">
                                    <label for="start{{ $index }}" class="font-semibold">Start</label>
                                    <input type="date" name="start[]" id="start{{ $index }}" class="w-full rounded"
                                        value="{{ $ex->start }}">
                                </div>

                                <div class="md:col-span-1">
                                    <label for="end{{ $index }}" class="font-semibold">End</label>
                                    <input type="date" name="end[]" id="end{{ $index }}" class="w-full rounded"
                                        value="{{ $ex->end }}">
                                </div>

                                <div class="md:col-span-full">
                                    <label for="job_description{{ $index }}"
                                        class="font-semibold">Description</label>
                                    <textarea class="rounded w-full" name="job_description[]"
                                        id="job_description{{ $index }}" cols="30"
                                        rows="10">{{ $ex->description }}</textarea>
                                </div>
                            </div>

                        @endforeach

                        <div id="exMessage" class="font-semibold mb-3">
                            <p>No Experience added yet!</p>
                        </div>

                    @else
                        <div id="exMessage" class="font-semibold mb-3">
                            <p>No Experience added yet!</p>
                        </div>
                    @endif

                </div>

                <div class="flex justify-end">
                    <button type="button" id="deleteExBtn"
                        class="bg-gray-600 hover:bg-gray-800 rounded text-white font-semibold transition-all px-3 py-2 mr-3">
                        Delete last
                    </button>
                    <button type="button" id="newExBtn"
                        class="bg-purple-600 hover:bg-purple-800 rounded text-white font-semibold transition-all px-3 py-2">
                        add new Ex
                    </button>
                </div>
            </div>

            <section x-data="">
                <h3 class="font-semibold text-xl border-b mb-5">Education</h3>

                <div class="education-main-container">
                    @if (old('company_name') !== null)

                        @for ($i = 0; $i < count(old('level')); $i++)
                            @php
                                $index = $i + 1;
                            @endphp

                            <div class="mb-4 education-container grid gap-5 md:grid-cols-2"
                                x-data="{ stillCoursing: false }">

                                <h4 class="text-lg border-b col-span-full">Education #{{ $index }}</h4>

                                <div class="col-span-2">
                                    <label for="level{{ $index }}" class="font-semibold">Level</label>
                                    <select id="level{{ $index }}" name="level[]" class="w-full rounded">
                                        <option value="1" @if (old('level.' . $i) == 1) cheked @endif>High school</option>
                                        <option value="2" @if (old('level.' . $i) == 2) cheked @endif>bachelor degree</option>
                                        <option value="3" @if (old('level.' . $i) == 3) cheked @endif>College</option>
                                        <option value="4" @if (old('level.' . $i) == 4) cheked @endif>Master's degree</option>
                                        <option value="5" @if (old('level.' . $i) == 5) cheked @endif>PHD</option>
                                    </select>
                                    @error('level')
                                        {{ $errors->first('level.' . $i) }}
                                    @enderror
                                </div>

                                <div class="md:col-span-1">
                                    <label for="course_name{{ $index }}" class="font-semibold">Course name</label>
                                    <input type="text" name="course_name[]" id="course_name{{ $index }}"
                                        class="w-full rounded" value="{{ old('course_name.' . $i) }}">
                                    @error('course_name.' . $i)
                                        {{ $errors->first('course_name.' . $i) }}
                                    @enderror
                                </div>

                                <div class="md:col-span-1">
                                    <label for="institution_name{{ $index }}" class="font-semibold">Institution
                                        name</label>
                                    <input type="text" name="institution_name[]" id="institution_name{{ $index }}"
                                        class="w-full rounded" value="{{ old('institution_name.' . $i) }}">
                                    @error('institution_name.' . $i)
                                        {{ $errors->first('institution_name.' . $i) }}
                                    @enderror
                                </div>

                                <div class="col-span-2 flex items-center">
                                    <input type="checkbox" x-model="stillCoursing" name="stillCoursing[]"
                                        id="stillCoursing{{ $i }}" class="rounded mr-3">
                                    <label for="stillCoursing{{ $i }}">Still coursing</label>
                                    @error('stillCoursing')
                                        {{ $error->first('stillCoursing.' . $i) }}
                                    @enderror
                                </div>

                                <div class="md:col-span-1">
                                    <label for="start_date{{ $index }}" class="font-semibold">Start date</label>
                                    <input type="date" name="start_date[]" id="start_date{{ $index }}"
                                        class="w-full rounded" value="{{ old('start_date.' . $i) }}">
                                    @error('start_date.' . $i)
                                        {{ $errors->first('start_date.' . $i) }}
                                    @enderror
                                </div>

                                <div class="md:col-span-1">
                                    <label for="end_date{{ $index }}" class="font-semibold">End date</label>
                                    <input type="date" name="end_date[]" id="end_date{{ $index }}"
                                        class="w-full rounded" value="{{ old('end_date.' . $i) }}"
                                        :readonly="stillCoursing">

                                    @error('end_date.' . $i)
                                        {{ $errors->first('end_date.' . $i) }}
                                    @enderror
                                </div>

                            </div>

                        @endfor

                        <div id="edMessage" class="font-semibold mb-3">
                            <p>No Education info added yet!</p>
                        </div>

                    @elseif ($resume->education)

                        @forelse ($resume->education as $i => $education)
                            @php
                                $index = $i + 1;
                            @endphp

                            <div class="mb-4 education-container grid gap-5 md:grid-cols-2"
                                x-data="{ stillCoursing: false }">

                                <h4 class="text-lg border-b col-span-full">Education #{{ $index }}</h4>

                                <div class="col-span-2">
                                    <label for="level{{ $index }}" class="font-semibold">Level</label>
                                    <select id="level{{ $index }}" name="level[]" class="w-full rounded">
                                        <option value="1" @if ($education->level == 1) cheked @endif>High school</option>
                                        <option value="2" @if ($education->level == 2) cheked @endif>bachelor degree</option>
                                        <option value="3" @if ($education->level == 3) cheked @endif>College</option>
                                        <option value="4" @if ($education->level == 4) cheked @endif>Master's degree</option>
                                        <option value="5" @if ($education->level == 5) cheked @endif>PHD</option>
                                    </select>

                                </div>

                                <div class="md:col-span-1">
                                    <label for="course_name{{ $index }}" class="font-semibold">Course name</label>
                                    <input type="text" name="course_name[]" id="course_name{{ $index }}"
                                        class="w-full rounded" value="{{ $resume->course_name }}">

                                </div>

                                <div class="md:col-span-1">
                                    <label for="institution_name{{ $index }}" class="font-semibold">Institution
                                        name</label>
                                    <input type="text" name="institution_name[]" id="institution_name{{ $index }}"
                                        class="w-full rounded" value="{{ $education->institution_name }}">
                                </div>

                                <div class="col-span-2 flex items-center">
                                    <input type="checkbox" x-model="stillCoursing" name="stillCoursing[]"
                                        id="stillCoursing{{ $i }}" class="rounded mr-3"
                                        @if ($educatino->stillCoursing) @endif>
                                    <label for="stillCoursing{{ $i }}">Still coursing</label>
                                </div>

                                <div class="md:col-span-1">
                                    <label for="start_date{{ $index }}" class="font-semibold">Start date</label>
                                    <input type="date" name="start_date[]" id="start_date{{ $index }}"
                                        class="w-full rounded" value="{{ $educatino->start_date }}">
                                </div>

                                <div class="md:col-span-1">
                                    <label for="end_date{{ $index }}" class="font-semibold">End date</label>
                                    <input type="date" name="end_date[]" id="end_date{{ $index }}"
                                        class="w-full rounded" value="{{ $education->end_date }}"
                                        :readonly="stillCoursing">
                                </div>

                            </div>

                        @empty
                            <div id="edMessage" class="font-semibold mb-3">
                                <p>No Education info added yet!</p>
                            </div>
                        @endforelse

                    @else
                        <div id="edMessage" class="font-semibold mb-3">
                            <p>No Education info added yet!</p>
                        </div>
                    @endif
                </div>

                <div>
                    <div class="flex justify-end">
                        <button type="button" id="deleteEdBtn"
                            class="bg-gray-600 hover:bg-gray-800 rounded text-white font-semibold transition-all px-3 py-2 mr-3">
                            Delete last
                        </button>
                        <button type="button" id="addEdBtn"
                            class="bg-purple-600 hover:bg-purple-800 rounded text-white font-semibold transition-all px-3 py-2">
                            Add new Ed
                        </button>
                    </div>
                </div>
            </section>

            <div class="col-span-full border-t flex justify-end py-5">
                <a href="{{ route('resume.index') }}"
                    class="mr-3 px-3 py-2 text-white font-semibold bg-gray-700 hover:bg-gray-900 transition-all rounded">
                    Cancel
                </a>
                <button type="submit"
                    class="px-3 py-2 text-white font-semibold bg-purple-700 hover:bg-purple-900 transition-all rounded">
                    submit
                </button>
            </div>
        </form>
    </main>
@endsection

@section('script')
    <script>
        const skills = {!! json_encode(explode(';', old('skills') ?? $resume->skills)) !!};
    </script>

    <script src="{{ asset('js/resume-form.js') }}"></script>
@endsection
