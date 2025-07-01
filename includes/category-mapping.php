<?php

class CategoryMapping {
    
   
    const EMPLOYEE_CATEGORIES = [
        'Unskilled Labor',
        'Skilled Labor', 
        'Technical',
        'Professional'
        
    ];
    
    
    const JOB_CATEGORIES = [
        'Local',
        'Explorer',
        'Tourist Guide',
        
        'Electrical',
        'Carpentry',
        'Cleaning',
        'Gardening',
        'Painting',
        'Explorer',
        'Repair',
        'Installation',
        'Cooking',
        'Driving',
        'Security',
        'IT Support',
        'Web Development',
        'Graphic Design',
        'Consulting',
        'Legal Services',
        'Medical Services',
        'Teaching',
        'Other',
        
    ];
    
    
    const CATEGORY_MAPPING = [

        'Local' => 'Professional',
        'Explorer'=> 'Professional',
      
        'Tourist Guide'=> 'Professional',
       
        'Cleaning' => 'Unskilled Labor',
        'Explorer' => 'Unskilled Labor',
        'Gardening' => 'Unskilled Labor',
        'Driving' => 'Unskilled Labor',
        'Security' => 'Unskilled Labor',

        
        'Electrical' => 'Skilled Labor',
        'Carpentry' => 'Skilled Labor',
        'Painting' => 'Skilled Labor',
        'Repair' => 'Skilled Labor',
        'Installation' => 'Skilled Labor',
        'Cooking' => 'Skilled Labor',
        

        'IT Support' => 'Technical',
        'Web Development' => 'Technical',
        'Graphic Design' => 'Technical',
        

        'Consulting' => 'Professional',
        'Legal Services' => 'Professional',
        'Medical Services' => 'Professional',
        'Teaching' => 'Professional',
        
        
        'Other' => 'Skilled Labor'
    ];
    
  
    public static function getEmployeeCategory($jobCategory) {
        return self::CATEGORY_MAPPING[$jobCategory] ?? 'Skilled Labor';
    }
    
    
    public static function getJobCategoriesForEmployee($employeeCategory) {
        $matchingJobs = [];
        foreach (self::CATEGORY_MAPPING as $jobCategory => $empCategory) {
            if ($empCategory === $employeeCategory) {
                $matchingJobs[] = $jobCategory;
            }
        }
        return $matchingJobs;
    }
    
    
    public static function getJobCategories() {
        return self::JOB_CATEGORIES;
    }
    
   
    public static function getEmployeeCategories() {
        return self::EMPLOYEE_CATEGORIES;
    }
    
    
    public static function isValidJobCategory($category) {
        return in_array($category, self::JOB_CATEGORIES);
    }
    
  
    
    public static function isValidEmployeeCategory($category) {
        return in_array($category, self::EMPLOYEE_CATEGORIES);
    }
    
   
    public static function getCategoryDescription($category) {
        $descriptions = [
            'Unskilled Labor' => 'General workers, helpers, and manual laborers for basic tasks',
            'Skilled Labor' => 'Plumbers, electricians, masons, carpenters, and other skilled tradespeople',
            'Technical' => 'Software engineers, IT professionals, technicians, and technical specialists',
            'Professional' => 'Doctors, lawyers, consultants, and other highly qualified professionals'
        ];
        
        return $descriptions[$category] ?? 'General category';
    }
}
?> 