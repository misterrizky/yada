<?php

namespace App\Models;

use App\Models\Approval\Approval;
use App\Models\Approval\ApprovalAction;
use App\Models\Approval\ApprovalRequest;
use App\Models\Approval\ApprovalWorkflow;
use App\Models\Approval\ApprovalWorkflowStep;
use App\Models\Asset\Asset;
use App\Models\Asset\AssetAssignment;
use App\Models\Asset\AssetMaintenance;
use App\Models\Asset\InventoryItem;
use App\Models\Asset\InventoryMovement;
use App\Models\Asset\StockAdjustment;
use App\Models\Asset\Warehouse;
use App\Models\CMS\KbArticle;
use App\Models\CMS\Menu;
use App\Models\CMS\MenuItem;
use App\Models\CMS\Page;
use App\Models\CMS\Post;
use App\Models\CMS\PostCategory;
use App\Models\CRM\Company;
use App\Models\CRM\CrmActivity;
use App\Models\CRM\Lead;
use App\Models\CRM\LeadActivity;
use App\Models\DMS\Document;
use App\Models\DMS\DocumentTemplate;
use App\Models\DMS\DocumentVersion;
use App\Models\DMS\Folder;
use App\Models\Finance\Budget;
use App\Models\Finance\CreditNote;
use App\Models\Finance\Expense;
use App\Models\Finance\ExpenseClaim;
use App\Models\Finance\Invoice;
use App\Models\Finance\InvoiceRecurring;
use App\Models\Finance\Payment;
use App\Models\Finance\Transaction;
use App\Models\HR\Department;
use App\Models\HR\EmployeeContract;
use App\Models\HR\EmployeeDocument;
use App\Models\HR\Leave;
use App\Models\HR\Payroll;
use App\Models\Master\Product;
use App\Models\Master\Solution;
use App\Models\PM\Project;
use App\Models\PM\ProjectMember;
use App\Models\PM\ProjectMilestone;
use App\Models\PM\SubTask;
use App\Models\PM\Task;
use App\Models\PM\TaskComment;
use App\Models\PM\TaskFile;
use App\Models\PM\TaskUser;
use App\Models\PM\Timesheet;
use App\Models\Procurement\GoodsReceipt;
use App\Models\Procurement\PurchaseOrder;
use App\Models\Procurement\PurchaseRequest;
use App\Models\Procurement\Vendor;
use App\Models\Procurement\VendorEvaluation;
use App\Models\QA\DeliverySignoff;
use App\Models\QA\QaChecklist;
use App\Models\QA\QaIssue;
use App\Models\QA\QaReview;
use App\Models\Resource\CapacityPlan;
use App\Models\Resource\ResourceAllocation;
use App\Models\Resource\ResourceRequest;
use App\Models\Resource\ResourceSkill;
use App\Models\Resource\TeamComposition;
use App\Models\Sales\Contract;
use App\Models\Sales\Order;
use App\Models\Sales\Proposal;
use App\Models\Sales\Quotation;
use App\Models\Support\CannedResponse;
use App\Models\Support\ComplianceChecklist;
use App\Models\Support\ComplianceReview;
use App\Models\Support\Ticket;
use App\Models\Support\TicketAgentAssignment;
use App\Models\Support\TicketFile;
use App\Models\Support\TicketReply;
use App\Models\User\UserAddress;
use App\Models\User\UserBank;
use App\Models\User\UserCertificate;
use App\Models\User\UserEducation;
use App\Models\User\UserLanguage;
use App\Models\User\UserNotification;
use App\Models\User\UserPortfolio;
use App\Models\User\UserProfile;
use App\Models\User\UserResume;
use App\Models\User\UserSkill;
use App\Models\User\UserSocial;
use App\Models\User\UserType;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Cmgmyr\Messenger\Traits\Messagable;
use Cog\Contracts\Ban\Bannable as BannableContract;
use Cog\Laravel\Ban\Traits\Bannable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Lab404\Impersonate\Models\Impersonate;
use Laravel\Fortify\TwoFactorAuthenticatable;
use LevelUp\Experience\Concerns\GiveExperience;
use LevelUp\Experience\Concerns\HasAchievements;
use LevelUp\Experience\Concerns\HasStreaks;
use Rappasoft\LaravelAuthenticationLog\Traits\AuthenticationLoggable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements BannableContract
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use AuthenticationLoggable, Bannable, GiveExperience, HasAchievements, HasFactory, HasRoles, HasStreaks, Impersonate, LogsActivity, Messagable, Notifiable, SoftDeletes, TwoFactorAuthenticatable;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    protected $fillable = [
        'user_type_id',
        'username',
        'name',
        'email',
        'phone',
        'email_verified_at',
        'phone_verified_at',
        'password',
        'workos_id',
        'avatar',
        'referral_code',
        'referred_by',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'two_factor_confirmed_at',
    ];

    protected $hidden = [
        'password',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'phone_verified_at' => 'datetime',
            'two_factor_confirmed_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function userType(): BelongsTo
    {
        return $this->belongsTo(UserType::class, 'user_type_id');
    }

    public function delegatedApprovalActions(): HasMany
    {
        return $this->hasMany(ApprovalAction::class, 'delegated_to');
    }

    public function approvalActions(): HasMany
    {
        return $this->hasMany(ApprovalAction::class, 'user_id');
    }

    public function requestedApprovalRequests(): HasMany
    {
        return $this->hasMany(ApprovalRequest::class, 'requested_by');
    }

    public function approverUserApprovalWorkflowSteps(): HasMany
    {
        return $this->hasMany(ApprovalWorkflowStep::class, 'approver_user_id');
    }

    public function escalateToUserApprovalWorkflowSteps(): HasMany
    {
        return $this->hasMany(ApprovalWorkflowStep::class, 'escalate_to_user_id');
    }

    public function createdApprovalWorkflows(): HasMany
    {
        return $this->hasMany(ApprovalWorkflow::class, 'created_by');
    }

    public function updatedApprovalWorkflows(): HasMany
    {
        return $this->hasMany(ApprovalWorkflow::class, 'updated_by');
    }

    public function approverApprovals(): HasMany
    {
        return $this->hasMany(Approval::class, 'approver_id');
    }

    public function requestedApprovals(): HasMany
    {
        return $this->hasMany(Approval::class, 'requested_by');
    }

    public function assignedByAssetAssignments(): HasMany
    {
        return $this->hasMany(AssetAssignment::class, 'assigned_by');
    }

    public function returnedByAssetAssignments(): HasMany
    {
        return $this->hasMany(AssetAssignment::class, 'returned_by');
    }

    public function createdAssetMaintenances(): HasMany
    {
        return $this->hasMany(AssetMaintenance::class, 'created_by');
    }

    public function performedAssetMaintenances(): HasMany
    {
        return $this->hasMany(AssetMaintenance::class, 'performed_by');
    }

    public function createdAssets(): HasMany
    {
        return $this->hasMany(Asset::class, 'created_by');
    }

    public function updatedAssets(): HasMany
    {
        return $this->hasMany(Asset::class, 'updated_by');
    }

    public function approvedBudgets(): HasMany
    {
        return $this->hasMany(Budget::class, 'approved_by');
    }

    public function createdBudgets(): HasMany
    {
        return $this->hasMany(Budget::class, 'created_by');
    }

    public function updatedBudgets(): HasMany
    {
        return $this->hasMany(Budget::class, 'updated_by');
    }

    public function createdCannedResponses(): HasMany
    {
        return $this->hasMany(CannedResponse::class, 'created_by');
    }

    public function createdCapacityPlans(): HasMany
    {
        return $this->hasMany(CapacityPlan::class, 'created_by');
    }

    public function updatedCapacityPlans(): HasMany
    {
        return $this->hasMany(CapacityPlan::class, 'updated_by');
    }

    public function createdCompanies(): HasMany
    {
        return $this->hasMany(Company::class, 'created_by');
    }

    public function updatedCompanies(): HasMany
    {
        return $this->hasMany(Company::class, 'updated_by');
    }

    public function companies(): HasMany
    {
        return $this->hasMany(Company::class, 'user_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function createdComplianceChecklists(): HasMany
    {
        return $this->hasMany(ComplianceChecklist::class, 'created_by');
    }

    public function updatedComplianceChecklists(): HasMany
    {
        return $this->hasMany(ComplianceChecklist::class, 'updated_by');
    }

    public function createdComplianceReviews(): HasMany
    {
        return $this->hasMany(ComplianceReview::class, 'created_by');
    }

    public function reviewedComplianceReviews(): HasMany
    {
        return $this->hasMany(ComplianceReview::class, 'reviewed_by');
    }

    public function reviewerComplianceReviews(): HasMany
    {
        return $this->hasMany(ComplianceReview::class, 'reviewer_id');
    }

    public function approvedContracts(): HasMany
    {
        return $this->hasMany(Contract::class, 'approved_by');
    }

    public function createdContracts(): HasMany
    {
        return $this->hasMany(Contract::class, 'created_by');
    }

    public function updatedContracts(): HasMany
    {
        return $this->hasMany(Contract::class, 'updated_by');
    }

    public function approvedCreditNotes(): HasMany
    {
        return $this->hasMany(CreditNote::class, 'approved_by');
    }

    public function createdCreditNotes(): HasMany
    {
        return $this->hasMany(CreditNote::class, 'created_by');
    }

    public function updatedCreditNotes(): HasMany
    {
        return $this->hasMany(CreditNote::class, 'updated_by');
    }

    public function createdCrmActivities(): HasMany
    {
        return $this->hasMany(CrmActivity::class, 'created_by');
    }

    public function crmActivities(): HasMany
    {
        return $this->hasMany(CrmActivity::class, 'user_id');
    }

    public function createdDeliverySignoffs(): HasMany
    {
        return $this->hasMany(DeliverySignoff::class, 'created_by');
    }

    public function pmSignoffDeliverySignoffs(): HasMany
    {
        return $this->hasMany(DeliverySignoff::class, 'pm_signoff_by');
    }

    public function updatedDeliverySignoffs(): HasMany
    {
        return $this->hasMany(DeliverySignoff::class, 'updated_by');
    }

    public function createdDepartments(): HasMany
    {
        return $this->hasMany(Department::class, 'created_by');
    }

    public function headedDepartments(): HasMany
    {
        return $this->hasMany(Department::class, 'head_id');
    }

    public function updatedDepartments(): HasMany
    {
        return $this->hasMany(Department::class, 'updated_by');
    }

    public function createdDocumentTemplates(): HasMany
    {
        return $this->hasMany(DocumentTemplate::class, 'created_by');
    }

    public function updatedDocumentTemplates(): HasMany
    {
        return $this->hasMany(DocumentTemplate::class, 'updated_by');
    }

    public function createdDocumentVersions(): HasMany
    {
        return $this->hasMany(DocumentVersion::class, 'created_by');
    }

    public function updatedDocumentVersions(): HasMany
    {
        return $this->hasMany(DocumentVersion::class, 'updated_by');
    }

    public function createdDocuments(): HasMany
    {
        return $this->hasMany(Document::class, 'created_by');
    }

    public function ownedDocuments(): HasMany
    {
        return $this->hasMany(Document::class, 'owner_id');
    }

    public function updatedDocuments(): HasMany
    {
        return $this->hasMany(Document::class, 'updated_by');
    }

    public function createdEmployeeContracts(): HasMany
    {
        return $this->hasMany(EmployeeContract::class, 'created_by');
    }

    public function createdEmployeeDocuments(): HasMany
    {
        return $this->hasMany(EmployeeDocument::class, 'created_by');
    }

    public function approvedExpenseClaims(): HasMany
    {
        return $this->hasMany(ExpenseClaim::class, 'approved_by');
    }

    public function createdExpenseClaims(): HasMany
    {
        return $this->hasMany(ExpenseClaim::class, 'created_by');
    }

    public function updatedExpenseClaims(): HasMany
    {
        return $this->hasMany(ExpenseClaim::class, 'updated_by');
    }

    public function approvedExpenses(): HasMany
    {
        return $this->hasMany(Expense::class, 'approved_by');
    }

    public function createdExpenses(): HasMany
    {
        return $this->hasMany(Expense::class, 'created_by');
    }

    public function updatedExpenses(): HasMany
    {
        return $this->hasMany(Expense::class, 'updated_by');
    }

    public function createdGoodsReceipts(): HasMany
    {
        return $this->hasMany(GoodsReceipt::class, 'created_by');
    }

    public function createdInventoryItems(): HasMany
    {
        return $this->hasMany(InventoryItem::class, 'created_by');
    }

    public function updatedInventoryItems(): HasMany
    {
        return $this->hasMany(InventoryItem::class, 'updated_by');
    }

    public function createdInventoryMovements(): HasMany
    {
        return $this->hasMany(InventoryMovement::class, 'created_by');
    }

    public function createdInvoiceRecurrings(): HasMany
    {
        return $this->hasMany(InvoiceRecurring::class, 'created_by');
    }

    public function approvedInvoices(): HasMany
    {
        return $this->hasMany(Invoice::class, 'approved_by');
    }

    public function createdInvoices(): HasMany
    {
        return $this->hasMany(Invoice::class, 'created_by');
    }

    public function updatedInvoices(): HasMany
    {
        return $this->hasMany(Invoice::class, 'updated_by');
    }

    public function createdKbArticles(): HasMany
    {
        return $this->hasMany(KbArticle::class, 'created_by');
    }

    public function updatedKbArticles(): HasMany
    {
        return $this->hasMany(KbArticle::class, 'updated_by');
    }

    public function leadActivities(): HasMany
    {
        return $this->hasMany(LeadActivity::class, 'user_id');
    }

    public function createdLeads(): HasMany
    {
        return $this->hasMany(Lead::class, 'created_by');
    }

    public function updatedLeads(): HasMany
    {
        return $this->hasMany(Lead::class, 'updated_by');
    }

    public function leads(): HasMany
    {
        return $this->hasMany(Lead::class, 'user_id');
    }

    public function approvedLeaves(): HasMany
    {
        return $this->hasMany(Leave::class, 'approved_by');
    }

    public function createdLeaves(): HasMany
    {
        return $this->hasMany(Leave::class, 'created_by');
    }

    public function createdMenuItems(): HasMany
    {
        return $this->hasMany(MenuItem::class, 'created_by');
    }

    public function updatedMenuItems(): HasMany
    {
        return $this->hasMany(MenuItem::class, 'updated_by');
    }

    public function createdMenus(): HasMany
    {
        return $this->hasMany(Menu::class, 'created_by');
    }

    public function updatedMenus(): HasMany
    {
        return $this->hasMany(Menu::class, 'updated_by');
    }

    public function approvedOrders(): HasMany
    {
        return $this->hasMany(Order::class, 'approved_by');
    }

    public function createdOrders(): HasMany
    {
        return $this->hasMany(Order::class, 'created_by');
    }

    public function updatedOrders(): HasMany
    {
        return $this->hasMany(Order::class, 'updated_by');
    }

    public function createdPages(): HasMany
    {
        return $this->hasMany(Page::class, 'created_by');
    }

    public function updatedPages(): HasMany
    {
        return $this->hasMany(Page::class, 'updated_by');
    }

    public function createdPayments(): HasMany
    {
        return $this->hasMany(Payment::class, 'created_by');
    }

    public function updatedPayments(): HasMany
    {
        return $this->hasMany(Payment::class, 'updated_by');
    }

    public function approvedPayrolls(): HasMany
    {
        return $this->hasMany(Payroll::class, 'approved_by');
    }

    public function createdPayrolls(): HasMany
    {
        return $this->hasMany(Payroll::class, 'created_by');
    }

    public function updatedPayrolls(): HasMany
    {
        return $this->hasMany(Payroll::class, 'updated_by');
    }

    public function createdPostCategories(): HasMany
    {
        return $this->hasMany(PostCategory::class, 'created_by');
    }

    public function updatedPostCategories(): HasMany
    {
        return $this->hasMany(PostCategory::class, 'updated_by');
    }

    public function authoredPosts(): HasMany
    {
        return $this->hasMany(Post::class, 'author_id');
    }

    public function createdPosts(): HasMany
    {
        return $this->hasMany(Post::class, 'created_by');
    }

    public function updatedPosts(): HasMany
    {
        return $this->hasMany(Post::class, 'updated_by');
    }

    public function createdProducts(): HasMany
    {
        return $this->hasMany(Product::class, 'created_by');
    }

    public function updatedProducts(): HasMany
    {
        return $this->hasMany(Product::class, 'updated_by');
    }

    public function projectMembers(): HasMany
    {
        return $this->hasMany(ProjectMember::class, 'user_id');
    }

    public function createdProjectMilestones(): HasMany
    {
        return $this->hasMany(ProjectMilestone::class, 'created_by');
    }

    public function createdProjects(): HasMany
    {
        return $this->hasMany(Project::class, 'created_by');
    }

    public function updatedProjects(): HasMany
    {
        return $this->hasMany(Project::class, 'updated_by');
    }

    public function approvedProposals(): HasMany
    {
        return $this->hasMany(Proposal::class, 'approved_by');
    }

    public function createdProposals(): HasMany
    {
        return $this->hasMany(Proposal::class, 'created_by');
    }

    public function updatedProposals(): HasMany
    {
        return $this->hasMany(Proposal::class, 'updated_by');
    }

    public function approvedPurchaseOrders(): HasMany
    {
        return $this->hasMany(PurchaseOrder::class, 'approved_by');
    }

    public function createdPurchaseOrders(): HasMany
    {
        return $this->hasMany(PurchaseOrder::class, 'created_by');
    }

    public function updatedPurchaseOrders(): HasMany
    {
        return $this->hasMany(PurchaseOrder::class, 'updated_by');
    }

    public function approvedPurchaseRequests(): HasMany
    {
        return $this->hasMany(PurchaseRequest::class, 'approved_by');
    }

    public function createdPurchaseRequests(): HasMany
    {
        return $this->hasMany(PurchaseRequest::class, 'created_by');
    }

    public function requestedPurchaseRequests(): HasMany
    {
        return $this->hasMany(PurchaseRequest::class, 'requested_by');
    }

    public function updatedPurchaseRequests(): HasMany
    {
        return $this->hasMany(PurchaseRequest::class, 'updated_by');
    }

    public function createdQaChecklists(): HasMany
    {
        return $this->hasMany(QaChecklist::class, 'created_by');
    }

    public function updatedQaChecklists(): HasMany
    {
        return $this->hasMany(QaChecklist::class, 'updated_by');
    }

    public function assignedQaIssues(): HasMany
    {
        return $this->hasMany(QaIssue::class, 'assigned_to');
    }

    public function createdQaIssues(): HasMany
    {
        return $this->hasMany(QaIssue::class, 'created_by');
    }

    public function reportedQaIssues(): HasMany
    {
        return $this->hasMany(QaIssue::class, 'reported_by');
    }

    public function updatedQaIssues(): HasMany
    {
        return $this->hasMany(QaIssue::class, 'updated_by');
    }

    public function verifiedQaIssues(): HasMany
    {
        return $this->hasMany(QaIssue::class, 'verified_by');
    }

    public function approvedQaReviews(): HasMany
    {
        return $this->hasMany(QaReview::class, 'approved_by');
    }

    public function createdQaReviews(): HasMany
    {
        return $this->hasMany(QaReview::class, 'created_by');
    }

    public function reviewerQaReviews(): HasMany
    {
        return $this->hasMany(QaReview::class, 'reviewer_id');
    }

    public function approvedQuotations(): HasMany
    {
        return $this->hasMany(Quotation::class, 'approved_by');
    }

    public function createdQuotations(): HasMany
    {
        return $this->hasMany(Quotation::class, 'created_by');
    }

    public function updatedQuotations(): HasMany
    {
        return $this->hasMany(Quotation::class, 'updated_by');
    }

    public function createdResourceAllocations(): HasMany
    {
        return $this->hasMany(ResourceAllocation::class, 'created_by');
    }

    public function updatedResourceAllocations(): HasMany
    {
        return $this->hasMany(ResourceAllocation::class, 'updated_by');
    }

    public function approvedResourceRequests(): HasMany
    {
        return $this->hasMany(ResourceRequest::class, 'approved_by');
    }

    public function createdResourceRequests(): HasMany
    {
        return $this->hasMany(ResourceRequest::class, 'created_by');
    }

    public function requestedResourceRequests(): HasMany
    {
        return $this->hasMany(ResourceRequest::class, 'requested_by');
    }

    public function verifiedResourceSkills(): HasMany
    {
        return $this->hasMany(ResourceSkill::class, 'verified_by');
    }

    public function createdSolutions(): HasMany
    {
        return $this->hasMany(Solution::class, 'created_by');
    }

    public function updatedSolutions(): HasMany
    {
        return $this->hasMany(Solution::class, 'updated_by');
    }

    public function approvedStockAdjustments(): HasMany
    {
        return $this->hasMany(StockAdjustment::class, 'approved_by');
    }

    public function createdStockAdjustments(): HasMany
    {
        return $this->hasMany(StockAdjustment::class, 'created_by');
    }

    public function assignedSubTasks(): HasMany
    {
        return $this->hasMany(SubTask::class, 'assigned_to');
    }

    public function createdSubTasks(): HasMany
    {
        return $this->hasMany(SubTask::class, 'created_by');
    }

    public function taskComments(): HasMany
    {
        return $this->hasMany(TaskComment::class, 'user_id');
    }

    public function taskFiles(): HasMany
    {
        return $this->hasMany(TaskFile::class, 'user_id');
    }

    public function taskUsers(): HasMany
    {
        return $this->hasMany(TaskUser::class, 'user_id');
    }

    public function assignedTasks(): HasMany
    {
        return $this->hasMany(Task::class, 'assigned_to');
    }

    public function createdTasks(): HasMany
    {
        return $this->hasMany(Task::class, 'created_by');
    }

    public function updatedTasks(): HasMany
    {
        return $this->hasMany(Task::class, 'updated_by');
    }

    public function createdTeamCompositions(): HasMany
    {
        return $this->hasMany(TeamComposition::class, 'created_by');
    }

    public function assignedByTicketAgentAssignments(): HasMany
    {
        return $this->hasMany(TicketAgentAssignment::class, 'assigned_by');
    }

    public function ticketAgentAssignments(): HasMany
    {
        return $this->hasMany(TicketAgentAssignment::class, 'user_id');
    }

    public function ticketFiles(): HasMany
    {
        return $this->hasMany(TicketFile::class, 'user_id');
    }

    public function ticketReplies(): HasMany
    {
        return $this->hasMany(TicketReply::class, 'user_id');
    }

    public function assignedTickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'assigned_to');
    }

    public function createdTickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'created_by');
    }

    public function updatedTickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'updated_by');
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'user_id');
    }

    public function approvedTimesheets(): HasMany
    {
        return $this->hasMany(Timesheet::class, 'approved_by');
    }

    public function createdTimesheets(): HasMany
    {
        return $this->hasMany(Timesheet::class, 'created_by');
    }

    public function timesheets(): HasMany
    {
        return $this->hasMany(Timesheet::class, 'user_id');
    }

    public function createdTransactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'created_by');
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(UserAddress::class, 'user_id');
    }

    public function banks(): HasMany
    {
        return $this->hasMany(UserBank::class, 'user_id');
    }

    public function certificates(): HasMany
    {
        return $this->hasMany(UserCertificate::class, 'user_id');
    }

    public function educations(): HasMany
    {
        return $this->hasMany(UserEducation::class, 'user_id');
    }

    public function languages(): HasMany
    {
        return $this->hasMany(UserLanguage::class, 'user_id');
    }

    public function userNotifications(): HasMany
    {
        return $this->hasMany(UserNotification::class, 'user_id');
    }

    public function portfolios(): HasMany
    {
        return $this->hasMany(UserPortfolio::class, 'user_id');
    }

    public function profile(): BelongsTo
    {
        return $this->belongsTo(UserProfile::class, 'user_id');
    }

    public function resumes(): HasMany
    {
        return $this->hasMany(UserResume::class, 'user_id');
    }

    public function skills(): HasMany
    {
        return $this->hasMany(UserSkill::class, 'user_id');
    }

    public function socials(): HasMany
    {
        return $this->hasMany(UserSocial::class, 'user_id');
    }

    public function evaluatedVendorEvaluations(): HasMany
    {
        return $this->hasMany(VendorEvaluation::class, 'evaluated_by');
    }

    public function reviewedVendorEvaluations(): HasMany
    {
        return $this->hasMany(VendorEvaluation::class, 'reviewed_by');
    }

    public function createdVendors(): HasMany
    {
        return $this->hasMany(Vendor::class, 'created_by');
    }

    public function updatedVendors(): HasMany
    {
        return $this->hasMany(Vendor::class, 'updated_by');
    }

    public function createdWarehouses(): HasMany
    {
        return $this->hasMany(Warehouse::class, 'created_by');
    }

    public function folders(): HasMany
    {
        return $this->hasMany(Folder::class, 'user_id');
    }

    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }
}
