<?php

namespace App\Helpers;

class AppUtils
{
    public function jobFunctionsData() : array
    {
        return [
            "Academic",
            "Advisory & Consulting Services",
            "Automation",
            "Business Management & Strategy",
            "C-Level / Board Director",
            "Coder / Developer / Programmer",
            "Customer Relationship Management",
            "Data Scientist/Architect/Artificial intelligence",
            "Digital Services",
            "Editorial",
            "Engineering",
            "Entrepreneurship",
            "Finance & Accounting",
            "Govt. Official",
            "Human Resources & Administration",
            "Information Technology & Management Information",
            "Manufacturing",
            "Marketing",
            "Media / Broadcasting / Communications",
            "Product or Service Development",
            "Project Management",
            "Quality Assurance / Control / Regulatory / Compliance",
            "Research / Development",
            "Sales",
            "Sales / Business Development",
            "Student",
            "Supply Chain / Logistics",
            "Training & Education",
            "Other"
        ];
    }

    public function roles() : array
    {
        return [
            'student',
            'freelancer',
            'employee',
            'business owner'
        ];
    }

    public function areaOfInterestsData() : array
    {
        return [
            "5G & Telecommunications",
            "AgriTech & FoodTech",
            "Artificial Intelligence & Robotics",
            "Big Data & Analytics",
            "Blockchain",
            "Cloud Services",
            "Coding and Development",
            "ConstrucTech & PropTech",
            "Consulting Services",
            "Consumer Tech, Smart Home & Smart Workplace",
            "Creative Economy",
            "Cyber security",
            "Data Centres & Data Management",
            "EdTech",
            "Environmental, Sustainability & Social Impact Tech",
            "Fintech, Finance and Ecommerce",
            "Future Mobility & Transportation",
            "Gaming",
            "Government & Public Policy",
            "HealthTech",
            "Internet of Things (IOT)",
            "Investment / VC / M&A/ PE",
            "Marketing Tech & Services",
            "Media, Content & Entertainment",
            "Metaverse & Immersive Tech",
            "Research & Development",
            "Smart Cities"
        ];
    }

    public function industriesData() : array
    {
        return [
            "Accounting",
            "Advertising/Marketing/PR",
            "Aerospace & Defense",
            "Agriculture",
            "Banking & Securities",
            "Call Center Outsourcing",
            "Consulting",
            "Consumer Products",
            "Education",
            "Energy, Chemical, Utilities",
            "Financial Services - Other",
            "Government - Federal",
            "Government - State & Local",
            "High Tech - Hardware",
            "High Tech - ISP",
            "High Tech - Other",
            "Hospital, Clinic, Doctor Office",
            "Hospitality, Travel, Tourism",
            "Insurance",
            "Legal",
            "Manufacturing",
            "Medical, Pharma, Biotech",
            "Real Estate",
            "Retail",
            "Software - Finance",
            "Software - Healthcare",
            "Software - Other",
            "Support Outsourcing",
            "Telecommunications",
            "Transportation & Distribution",
            "VAR/Systems Integrator",
            "Other"
        ];
    }

    public function sectorsData() : array
    {
        return [
            "Agriculture",
            "Arts Entertainment",
            "Automotive",
            "Aviation",
            "Construction & Infrastructure",
            "Cosmetics",
            "Defense & Space",
            "Education",
            "Fintech",
            "Energy",
            "Environmental Services",
            "Fashion & Apparel",
            "Finance & Insurance",
            "FMCG",
            "Government",
            "Healthcare",
            "Hospitality & Travel",
            "Import & Export",
            "Jewellery & Luxury Goods",
            "Legal",
            "Logistics & Supply Chain",
            "Manufacturing",
            "Real Estate",
            "Research & Development",
            "Retail Trade",
            "Technology",
            "Telecoms",
            "Utilities",
            "Wholesale Trade",
            "Other"
        ];
    }

    public function acceptedReasons() : array
    {
        return [
            "Source products/services",
            "Attend workshops/conferences",
            "Network with partners, clients and suppliers",
            "Evaluate exhibiting opportunities",
            "Keep an eye on my competitors",
            "Learn about the latest industry trends",
            "Find startups to invest in"
        ];
    }
}
