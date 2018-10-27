<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CreateMemberShipPlanRequest;
use App\Http\Requests\Admin\UpdateMemberShipPlanRequest;
use App\Repositories\Admin\MemberShipPlanRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class MemberShipPlanController extends Controller
{
    /** @var  MemberShipPlanRepository */
    private $memberShipPlanRepository;

    public function __construct(MemberShipPlanRepository $memberShipPlanRepo)
    {
        $this->memberShipPlanRepository = $memberShipPlanRepo;
    }

    /**
     * Display a listing of the MemberShipPlan.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->memberShipPlanRepository->pushCriteria(new RequestCriteria($request));
        $memberShipPlans = $this->memberShipPlanRepository->all();

        return view('admin.member_ship_plans.index')->with('memberShipPlans', $memberShipPlans);
    }

    /**
     * Show the form for creating a new MemberShipPlan.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.member_ship_plans.create');
    }

    /**
     * Store a newly created MemberShipPlan in storage.
     *
     * @param CreateMemberShipPlanRequest $request
     *
     * @return Response
     */
    public function store(CreateMemberShipPlanRequest $request)
    {
        $input = $request->all();

        $memberShipPlan = $this->memberShipPlanRepository->create($input);

        Flash::success('Member Ship Plan saved successfully.');

        return redirect(route('admin.memberShipPlans.index'));
    }

    /**
     * Display the specified MemberShipPlan.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $memberShipPlan = $this->memberShipPlanRepository->findWithoutFail($id);

        if (empty($memberShipPlan)) {
            Flash::error('Member Ship Plan not found');

            return redirect(route('admin.memberShipPlans.index'));
        }

        return view('admin.member_ship_plans.show')->with('memberShipPlan', $memberShipPlan);
    }

    /**
     * Show the form for editing the specified MemberShipPlan.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $memberShipPlan = $this->memberShipPlanRepository->findWithoutFail($id);

        if (empty($memberShipPlan)) {
            Flash::error('Member Ship Plan not found');

            return redirect(route('admin.memberShipPlans.index'));
        }

        return view('admin.member_ship_plans.edit')->with('memberShipPlan', $memberShipPlan);
    }

    /**
     * Update the specified MemberShipPlan in storage.
     *
     * @param  int              $id
     * @param UpdateMemberShipPlanRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMemberShipPlanRequest $request)
    {
        $memberShipPlan = $this->memberShipPlanRepository->findWithoutFail($id);

        if (empty($memberShipPlan)) {
            Flash::error('Member Ship Plan not found');

            return redirect(route('admin.memberShipPlans.index'));
        }

        $memberShipPlan = $this->memberShipPlanRepository->update($request->all(), $id);

        Flash::success('Member Ship Plan updated successfully.');

        return redirect(route('admin.memberShipPlans.index'));
    }

    /**
     * Remove the specified MemberShipPlan from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $memberShipPlan = $this->memberShipPlanRepository->findWithoutFail($id);

        if (empty($memberShipPlan)) {
            Flash::error('Member Ship Plan not found');

            return redirect(route('admin.memberShipPlans.index'));
        }

        $this->memberShipPlanRepository->delete($id);

        Flash::success('Member Ship Plan deleted successfully.');

        return redirect(route('admin.memberShipPlans.index'));
    }
}
