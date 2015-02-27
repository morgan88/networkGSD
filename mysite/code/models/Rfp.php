<?php
class Rfp extends DataObject{
  static private $db = array('Deleted'=>'Int' ,
                             'Awarded'=>'Int' ,
                             'Title' =>'Varchar(50)',
                             'Number_Of_Attorneys'=>'Varchar(50)', 
                             'Job_Type'=>'Varchar(50)',
                             'Job_Category'=>'Varchar(100)',
                             'Company_Overview'=>'Text',
                             'Description'=>'Text',
                             'Job_Timeframe'=>'Varchar(150)',
                             'Submission_Deadline'=>'Date',
                             'Years_Of_Practice'=>'Varchar(50)',
                             'Budget'=>'Varchar(50)',
                             'Gender'=>'Varchar(50)',
                             'Project_Start'=>'SS_Datetime',
                             'Project_End'=>'SS_Datetime',
                             'Ethnicity'=>'Varchar(200)');
  static private $has_one = array('Company'=>'Company','Member'=>'Member');
  static private $has_many = array('Messages'=>'Message','QA'=>'Rfp_QA');
  
   public function diversity(){
    
    return Diversity::get()->filter(array('Related_ID'=>$this->ID,'Type'=>'Rfp'));
  }
  
  public function barstates(){
    
    return BarState::get()->filter(array('Related_ID'=>$this->ID,'Type'=>'Rfp'));
  }
  public function  BarState(){
    
    return BarState::get()->filter(array('Related_ID'=>$this->ID,'Type'=>'Rfp'));
  }
   public function  Language(){
    
    return Language::get()->filter(array('Related_ID'=>$this->ID,'Type'=>'Rfp'));
  }

public function  Association(){
    
    return Association::get()->filter(array('Related_ID'=>$this->ID,'Type'=>'Rfp'));
  }
  public function  Cert(){
    
    return Cert::get()->filter(array('Related_ID'=>$this->ID,'Type'=>'Rfp'));
  }
  
  public function practiceAreas(){
    
    return  PracticeArea::get()->filter(array('Related_ID'=>$this->ID,'Type'=>'Rfp'));
  }
  public function  PracticeArea(){
     return  PracticeArea::get()->filter(array('Related_ID'=>$this->ID,'Type'=>'Rfp'));
  } 

  public function Diversity_selects(){
    $divs =Diversity::get()->filter(array('Related_ID'=>$this->ID,'Type'=>'Rfp'))->map('Diversity_ListID','Diversity_ListID')->toArray();
    return Diversity_List::get()->exclude('ID',array_values($divs));
  }
  public function description_preview(){
    
    return substr($this->Description,0,200);
  }
  
    public function description_text(){
     $cc =new HTMLText(); 
     $cc->setValue($this->Description);
    return $cc;
  }
  
  public function applications(){
    return Message::get()->filter(array('Type'=>'rfpapply','RfpID'=>$this->ID));
  }
  
  public function applicants(){
    $ids =$this->applications()->map('ID','From_ID')->toArray();
    if(empty($ids)){ return new ArrayList();}
    else
    return Member::get()->byIDs(array_values($ids));
    
  }

  
  
  
}