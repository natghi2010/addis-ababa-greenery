<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name"=>"required|unique:projects",
            "description"=>"required",
            "location_lat"=>"required",
            "location_long"=>"required",
            "subcity_id"=>"required",
            "milestones.*.name"=>"required",
            "milestones.*.description"=>"required",
            "milestones.tasks.*.title"=>"required",
            "milestones.tasks.*.description"=>"required",
            "team_leader_id"=>"required",
            "team_members.*.user_id"=>"required",

        ];
    }

    public function messages()
    {
        return [
            "name.required"=>"Project name is required",
            "name.unique"=>"Project name is already taken",
            "description.required"=>"Project description is required",
            "location_lat.required"=>"Project location latitude is required. Please select a location on the map",
            "location_long.required"=>"Project location longitude is required. Please select a location on the map",
            "subcity_id.required"=>"subcity is required",
            "milestones.*.name.required"=>"Milestone name is required",
            "milestones.*.description.required"=>"Milestone description is required",
            "milestones.tasks.*.title.required"=>"Task name is required",
            "milestones.tasks.*.description.required"=>"Task description is required",
            "team_leader_id.required"=>"Team leader is required",
            "team_members.*.user_id.required"=>"Team member is required",
        ];
    }

}
