<?php

namespace App\Http\Livewire\Agent\Setting;

use App\Enums\CustomFieldType;
use App\Models\CustomField;
use App\Models\Ticket;
use App\Settings\TicketSettings;
use Illuminate\Validation\Rules\Enum;
use Livewire\Component;

class TicketSettingsManager extends Component
{
    public $allowAssignmentToAdmins;
    public $allowAgentToAssignTicket;
    public $allowAgentToResignTicket;
    public $allowAgentToSeeLicenseCode;
    public $autoAssignmentEnabled;
    public $autoAssignmentUseRandomAgent;
    public $maxCommentsPerPage;
    public $maxAttachmentUploadSize;
    public $maxImageUploadSize;
    public $creatingCustomField = false;
    public $customField;

    protected function rules()
    {
        return [
            'allowAssignmentToAdmins' => 'boolean',
            'allowAgentToAssignTicket' => 'boolean',
            'allowAgentToResignTicket' => 'boolean',
            'allowAgentToSeeLicenseCode' => 'boolean',
            'autoAssignmentEnabled' => 'boolean',
            'maxCommentsPerPage' => 'integer|min:1|max:9999',
            'maxAttachmentUploadSize' => 'integer|min:1',
            'maxImageUploadSize' => 'integer|min:1',
            'customField.model' => 'required',
            'customField.title' => 'required',
            'customField.description' => 'nullable',
            'customField.type' => ['required', new Enum(CustomFieldType::class)],
            'customField.is_required' => 'boolean',
        ];
    }

    public function mount()
    {
        abort_if(! auth()->user()->is_admin, 403);
        $this->allowAssignmentToAdmins = $this->ticketSettings->allow_assignment_to_admins;
        $this->allowAgentToAssignTicket = $this->ticketSettings->allow_agent_to_assign_ticket;
        $this->allowAgentToResignTicket = $this->ticketSettings->allow_agent_to_resign_ticket;
        $this->allowAgentToSeeLicenseCode = $this->ticketSettings->allow_agent_to_see_license_code;
        $this->autoAssignmentEnabled = $this->ticketSettings->auto_assignment_enabled;
        $this->autoAssignmentUseRandomAgent = $this->ticketSettings->auto_assignment_use_random_agent;
        $this->maxCommentsPerPage = $this->ticketSettings->max_comments_per_page;
        $this->maxAttachmentUploadSize = $this->ticketSettings->max_attachment_upload_size;
        $this->maxImageUploadSize = $this->ticketSettings->max_image_upload_size;
    }

    public function save()
    {
        $this->validate([
            'allowAssignmentToAdmins' => 'boolean',
            'allowAgentToAssignTicket' => 'boolean',
            'allowAgentToResignTicket' => 'boolean',
            'allowAgentToSeeLicenseCode' => 'boolean',
            'autoAssignmentEnabled' => 'boolean',
            'maxCommentsPerPage' => 'integer|min:1|max:9999',
            'maxAttachmentUploadSize' => 'integer|min:1',
            'maxImageUploadSize' => 'integer|min:1',
        ]);

        $this->ticketSettings->allow_assignment_to_admins = $this->allowAssignmentToAdmins;
        $this->ticketSettings->allow_agent_to_assign_ticket = $this->allowAgentToAssignTicket;
        $this->ticketSettings->allow_agent_to_resign_ticket = $this->allowAgentToResignTicket;
        $this->ticketSettings->allow_agent_to_see_license_code = $this->allowAgentToSeeLicenseCode;
        $this->ticketSettings->auto_assignment_enabled = $this->autoAssignmentEnabled;
        $this->ticketSettings->auto_assignment_use_random_agent = $this->autoAssignmentUseRandomAgent;
        $this->ticketSettings->max_comments_per_page = $this->maxCommentsPerPage;
        $this->ticketSettings->max_attachment_upload_size = $this->maxAttachmentUploadSize;
        $this->ticketSettings->max_image_upload_size = $this->maxImageUploadSize;

        $this->ticketSettings->save();

        $this->emitSelf('saved');
    }

    public function createCustomField()
    {
        $this->customField = new CustomField([
            'model' => Ticket::class,
            'type' => CustomFieldType::TEXT,
            'is_required' => false,
        ]);

        $this->creatingCustomField = true;
    }

    public function editCustomField(CustomField $customFieldId)
    {
        $this->customField = $customFieldId;

        $this->creatingCustomField = true;
    }

    public function saveCustomField()
    {
        $this->validate([
            'customField.model' => 'required',
            'customField.title' => 'required',
            'customField.description' => 'nullable',
            'customField.type' => ['required', new Enum(CustomFieldType::class)],
            'customField.is_required' => 'boolean',
        ]);

        $this->customField->save();

        $this->creatingCustomField = false;
    }

    public function deleteCustomField(CustomField $customFieldId)
    {
        $customFieldId->delete();
    }

    public function getTicketSettingsProperty()
    {
        return app(TicketSettings::class);
    }

    public function getCustomFieldsProperty()
    {
        return CustomField::query()->where('model', Ticket::class)->get();
    }

    public function render()
    {
        return view('livewire.agent.setting.ticket-settings-manager');
    }
}
