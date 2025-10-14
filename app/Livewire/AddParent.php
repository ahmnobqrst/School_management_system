<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\MyParent;
use App\Models\National;
use App\Models\Religions;
use App\Models\BloodType;
use App\Models\ParentAttachment;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;


class AddParent extends Component
{

    use WithFileUploads;

   public $successMessage = '';
    public $currentStep = 1;
    public $updateMode = false, $photos,$show_table = true,$parent_id,$catchError;

    public $email,$password,
    $name_of_father_ar,$name_of_father_en,$father_job_ar,$father_job_en,
    $father_ID,$father_phone,$national_father_id,$blood_type_father_id,
    $religion_father_id,$father_address_ar,$father_address_en,


    $name_of_mother_ar,$name_of_mother_en,$mother_job_ar,$mother_job_en,
    $mother_ID,$mother_phone,$national_mother_id,$blood_type_mother_id,
    $mother_address_ar,$mother_address_en;


  public function formaddparent(){
    $this->show_table = false;
  }
    
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'email' => 'required|email',
            'father_ID' => 'required|string|min:14|max:14|regex:/[0-9]{9}/',
            'father_phone' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:11',
            'mother_ID' => 'required|string|min:14|max:14|regex:/[0-9]{9}/',
            'mother_phone' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:11'
        ]);
    }
   

    public function render()
    {

        return view('livewire.add-parent', [
            'Nationalities' => National::all(),
            'Type_Bloods' => BloodType::all(),
            'Religions' => Religions::all(),
            'my_parents'=>MyParent::paginate(1),
        ]);

    }

    public function firstStepSubmit(){

        
        $this->validate([
            'email' => 'required|unique:my_parents,email,',
            'password' => 'required',
            'name_of_father_ar' => 'required',
            'name_of_father_en' => 'required',
            'father_job_ar' => 'required',
            'father_job_en' => 'required',
            'father_ID' => 'required|unique:my_parents,father_ID,',
            'father_phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:11',
            'national_father_id' => 'required',
            'blood_type_father_id' => 'required',
            'religion_father_id' => 'required',
            'father_address_ar' => 'required',
            'father_address_en' => 'required',
        ]);

        $this->currentStep = 2;
    }

    public function secondStepSubmit(){

        $this->validate([
            'name_of_mother_ar' => 'required',
            'name_of_mother_en' => 'required',
            'mother_ID' => 'required|unique:my_parents,mother_ID,',
            'mother_phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:11',
            'mother_job_ar' => 'required',
            'mother_job_en' => 'required',
            'national_mother_id' => 'required',
            'blood_type_mother_id' => 'required',
            'mother_address_ar' => 'required',
            'mother_address_en' => 'required',
        ]);

        $this->currentStep = 3;
    }


    
    public function submitForm(){

        try{

        $great = new MyParent();
        $great->email = $this->email;
        $great->password = $this->password;
        $great->name_of_father = ['en'=>$this->name_of_father_en,'ar'=>$this->name_of_father_ar];
        $great->father_job = ['en'=>$this->father_job_en,'ar'=>$this->father_job_ar];
        $great->father_address = ['en'=>$this->father_address_en,'ar'=>$this->father_address_ar];
        $great->father_ID = $this->father_ID;
        $great->father_phone = $this->father_phone;
        $great->national_father_id = $this->national_father_id;
        $great->blood_type_father_id = $this->blood_type_father_id;
        $great->religion_father_id = $this->religion_father_id;

        $great->name_of_mother = ['en'=>$this->name_of_mother_en,'ar'=>$this->name_of_mother_ar];
        $great->mother_job = ['en'=>$this->mother_job_en,'ar'=>$this->mother_job_ar];
        $great->mother_address = ['en'=>$this->mother_address_en,'ar'=>$this->mother_address_ar];
        $great->mother_ID = $this->mother_ID;
        $great->mother_phone = $this->mother_phone;
        $great->national_mother_id = $this->national_mother_id;
        $great->blood_type_mother_id = $this->blood_type_mother_id;
        $great->save();

        if (!empty($this->photos)){
            foreach ($this->photos as $photo) {
                $photo->storeAs($this->father_ID, $photo->getClientOriginalName(), $disk = 'parent_attachments');
                ParentAttachment::create([
                    'file_name' => $photo->getClientOriginalName(),
                    'parent_id' => MyParent::latest()->first()->id, // ده معناه هات اخر id اتعمله حفظ في الداتا بيز ال هو بيكون ال بنضيف فبه حاليا
                ]);
            }
        }


        $this->successMessage = __('parent_trans.success');
        $this->clearForm();
        $this->currentStep = 1;
        
        

        }

        catch (\Exception $e) {
            $this->catchError = $e->getMessage();
        }


    }

    public function edit($id)
    {

        $this->show_table = false;
        $this->updateMode = true;
        $Myparent = MyParent::where('id',$id)->first();
        $this->parent_id = $id;
        $this->email = $Myparent->email;
        $this->password = $Myparent->password;
        $this->name_of_father_ar = $Myparent->getTranslation('name_of_father', 'ar');
        $this->name_of_father_en = $Myparent->getTranslation('name_of_father', 'en');
        $this->father_job_ar = $Myparent->getTranslation('father_job', 'ar');;
        $this->father_job_en = $Myparent->getTranslation('father_job', 'en');
        $this->father_ID =$Myparent->father_ID;
        $this->father_phone = $Myparent->father_phone;
        $this->national_father_id = $Myparent->national_father_id;
        $this->blood_type_father_id = $Myparent->blood_type_father_id;
        $this->father_address_ar = $Myparent->getTranslation('father_address', 'ar');
        $this->father_address_en = $Myparent->getTranslation('father_address', 'en');
        $this->religion_father_id =$Myparent->religion_father_id;

        $this->name_of_mother_ar = $Myparent->getTranslation('name_of_mother', 'ar');
        $this->name_of_mother_en = $Myparent->getTranslation('name_of_mother', 'en');
        $this->mother_job_ar = $Myparent->getTranslation('mother_job', 'ar');;
        $this->mother_job_en = $Myparent->getTranslation('mother_job', 'en');
        $this->mother_ID =$Myparent->mother_ID;
        $this->mother_phone = $Myparent->mother_phone;
        $this->national_mother_id = $Myparent->national_mother_id;
        $this->blood_type_mother_id = $Myparent->blood_type_mother_id;
        $this->mother_address_ar = $Myparent->getTranslation('mother_address', 'ar');
        $this->mother_address_en = $Myparent->getTranslation('mother_address', 'en');
    }

    public function edit_submit()
    {
        $this->updateMode = true;
        $this->currentStep = 2;
    }

    public function second_form_edit()
    {
        $this->updateMode = true;
        $this->currentStep = 3;
    }

    public function submitForm_edit()
    {
       if($this->parent_id){
        $parents = MyParent::findOrFail($this->parent_id);
        $parents->update([

         'email'  => $this->email,
         'password'  => $this->password,
         'name_of_father'  => ['ar'=>$this->name_of_father_ar,'en'=>$this->name_of_father_en],
         'father_job'  => ['ar'=>$this->father_job_ar,'en'=>$this->father_job_en],
         'father_ID'  =>$this->father_ID,
         'father_phone'  => $this->father_phone,
         'national_father_id'  => $this->national_father_id,
         'blood_type_father_id'  => $this->blood_type_father_id,
         'father_address'  => ['ar'=>$this->father_address_ar,'en'=>$this->father_address_en],
         'religion_father_id'  =>$this->religion_father_id,

        'name_of_mother'  => ['ar'=>$this->name_of_mother_ar,'en'=>$this->name_of_mother_en],
        'mother_job'  => ['ar'=>$this->mother_job_ar,'en'=>$this->mother_job_en],
         'mother_ID'  =>$this->mother_ID,
        ' mother_phone'  => $this->mother_phone,
         'national_mother_id'  => $this->national_mother_id,
        'blood_type_mother_id'  => $this->blood_type_mother_id,
        'mother_address'  => ['ar'=>$this->mother_address_ar,'en'=>$this->mother_address_en],

        ]);

        return redirect()->to('/add_parent');
        $this->successMessage = __('parent_trans.updated');
       }
    
    }

    public function delete($id){

    $parent_id = ParentAttachment::where('parent_id',$id)->pluck('parent_id');
    if($parent_id->count() == 0 ){
      if(is_numeric($id)){ 
        MyParent::where('id', $id)->delete();
    }

    toastr()->error(trans('parent_trans.Delete_parent'));
    return redirect()->to('/add_parent');

    }
    else{
      toastr()->error(trans('parent_trans.error_parent_delete'));
      return redirect()->to('/add_parent');
    }
    }


    public function clearForm()
    {
        $this->email = '';
        $this->password = '';
        $this->name_of_father_ar = '';
        $this->name_of_father_en= '';
        $this->father_job_ar = '';
        $this->father_job_en = '';
        $this->father_ID ='';
        $this->father_phone = '';
        $this->national_father_id = '';
        $this->blood_type_father_id = '';
        $this->religion_father_id ='';
        $this->father_address_ar ='';
        $this->father_address_en ='';
       
        $this->name_of_mother_ar = '';
        $this->name_of_mother_en = '';
        $this->mother_job_ar = '';
        $this->mother_job_en= '';
        $this->mother_ID ='';
        $this->mother_phone = '';
        $this->national_mother_id = '';
        $this->blood_type_mother_id = '';
        $this->mother_address_ar ='';
        $this->mother_address_en ='';

    }

    public function back($step){
        $this->currentStep = $step;
    }


   

    
}
