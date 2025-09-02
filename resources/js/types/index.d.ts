import { LucideIcon } from 'lucide-react';
import type { Config } from 'ziggy-js';

export interface Auth {
    user: User;
}

export interface BreadcrumbItem {
    title: string;
    href: string;
}

export interface NavGroup {
    title: string;
    items: NavItem[];
}

export interface NavItem {
    title: string;
    href: string;
    icon?: LucideIcon | null;
    isActive?: boolean;
}

export interface SharedData {
    name: string;
    quote: { message: string; author: string };
    auth: Auth;
    ziggy: Config & { location: string };
    sidebarOpen: boolean;
    [key: string]: unknown;
}

export interface User {
    id: number;
    name: string;
    email: string;
    role: 'admin' | 'teacher' | 'student' | 'parent';
    phone?: string | null;
    student_id?: string | null;
    parent_id?: string | null;
    status: 'active' | 'inactive';
    avatar?: string;
    email_verified_at: string | null;
    created_at: string;
    updated_at: string;
    [key: string]: unknown; // This allows for additional properties...
}

export interface SchoolClass {
    id: number;
    name: string;
    grade: string;
    teacher_id?: number | null;
    capacity: number;
    description?: string | null;
    status: 'active' | 'inactive';
    created_at: string;
    updated_at: string;
}

export interface Subject {
    id: number;
    name: string;
    code: string;
    description?: string | null;
    credits: number;
    status: 'active' | 'inactive';
    created_at: string;
    updated_at: string;
}

export interface Exam {
    id: number;
    title: string;
    description?: string | null;
    subject_id: number;
    class_id: number;
    teacher_id: number;
    start_time: string;
    end_time: string;
    duration: number;
    total_questions: number;
    total_points: number;
    status: 'draft' | 'published' | 'ongoing' | 'completed';
    created_at: string;
    updated_at: string;
}

export interface Grade {
    id: number;
    student_id: number;
    subject_id: number;
    class_id: number;
    assessment_type: string;
    assessment_name: string;
    score: number;
    max_score: number;
    percentage: number;
    grade_letter?: string | null;
    assessment_date: string;
    teacher_id: number;
    notes?: string | null;
    created_at: string;
    updated_at: string;
    student?: User;
    subject?: Subject;
    teacher?: User;
}
