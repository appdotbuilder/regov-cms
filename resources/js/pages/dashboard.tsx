import React from 'react';
import { Head } from '@inertiajs/react';
import { usePage } from '@inertiajs/react';
import AppLayout from '@/layouts/app-layout';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Button } from '@/components/ui/button';
import { type BreadcrumbItem } from '@/types';

interface SharedData {
    auth: {
        user: {
            id: number;
            name: string;
            email: string;
        } | null;
    };
    [key: string]: unknown;
}

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

export default function Dashboard() {
    const { auth } = usePage<SharedData>().props;

    const dashboardCards = [
        {
            title: '📰 News Management',
            description: 'Create, edit, and publish news articles',
            icon: '📰',
            stats: 'Latest articles and drafts',
            action: 'Manage News',
            href: '/admin/news'
        },
        {
            title: '📢 Announcements',
            description: 'Manage public announcements and alerts',
            icon: '📢',
            stats: 'Active announcements',
            action: 'Manage Announcements',
            href: '/admin/announcements'
        },
        {
            title: '🛡️ Services',
            description: 'Public services and applications',
            icon: '🛡️',
            stats: 'Available services',
            action: 'Manage Services',
            href: '/admin/services'
        },
        {
            title: '📅 Events',
            description: 'Event calendar and scheduling',
            icon: '📅',
            stats: 'Upcoming events',
            action: 'Manage Events',
            href: '/admin/events'
        },
        {
            title: '🏢 Departments',
            description: 'Department profiles and information',
            icon: '🏢',
            stats: 'Active departments',
            action: 'Manage Departments',
            href: '/admin/departments'
        },
        {
            title: '📸 Gallery',
            description: 'Photo and video media management',
            icon: '📸',
            stats: 'Media items',
            action: 'Manage Gallery',
            href: '/admin/gallery'
        },
        {
            title: '📄 Documents',
            description: 'Document library and downloads',
            icon: '📄',
            stats: 'Available documents',
            action: 'Manage Documents',
            href: '/admin/documents'
        },
        {
            title: '📝 Forms',
            description: 'Online forms and submissions',
            icon: '📝',
            stats: 'Active forms',
            action: 'Manage Forms',
            href: '/admin/forms'
        },
        {
            title: '📊 Analytics',
            description: 'Visitor statistics and reports',
            icon: '📊',
            stats: 'Website analytics',
            action: 'View Analytics',
            href: '/admin/analytics'
        },
        {
            title: '👥 User Management',
            description: 'Staff accounts and permissions',
            icon: '👥',
            stats: 'Active users',
            action: 'Manage Users',
            href: '/admin/users'
        },
        {
            title: '📄 Pages',
            description: 'Static page content management',
            icon: '📄',
            stats: 'Published pages',
            action: 'Manage Pages',
            href: '/admin/pages'
        },
        {
            title: '⚙️ Settings',
            description: 'System configuration and preferences',
            icon: '⚙️',
            stats: 'System settings',
            action: 'Configure Settings',
            href: '/admin/settings'
        }
    ];

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="CMS Dashboard" />

            <div className="py-8">
                <div className="mx-auto max-w-7xl px-4">
                    {/* Welcome Header */}
                    <div className="mb-8">
                        <div className="bg-gradient-to-r from-blue-600 to-blue-800 rounded-lg p-8 text-white">
                            <h1 className="text-3xl font-bold mb-2">
                                Welcome back, {auth.user?.name}! 👋
                            </h1>
                            <p className="text-blue-100 text-lg">
                                🏛️ Regional Government Content Management System
                            </p>
                            <div className="mt-4 flex gap-4">
                                <Button 
                                    className="bg-yellow-500 hover:bg-yellow-600 text-black"
                                    onClick={() => window.open('/', '_blank')}
                                >
                                    🌐 View Public Site
                                </Button>
                                <Button 
                                    variant="outline" 
                                    className="text-white border-white hover:bg-white hover:text-blue-800"
                                    onClick={() => alert('Quick Post - Feature coming soon!')}
                                >
                                    ✍️ Quick Post
                                </Button>
                            </div>
                        </div>
                    </div>

                    {/* Quick Stats */}
                    <div className="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                        <Card className="border-blue-200">
                            <CardContent className="p-6 text-center">
                                <div className="text-2xl font-bold text-blue-600 mb-1">24</div>
                                <div className="text-sm text-gray-600">📰 Published News</div>
                            </CardContent>
                        </Card>
                        <Card className="border-green-200">
                            <CardContent className="p-6 text-center">
                                <div className="text-2xl font-bold text-green-600 mb-1">12</div>
                                <div className="text-sm text-gray-600">🛡️ Active Services</div>
                            </CardContent>
                        </Card>
                        <Card className="border-purple-200">
                            <CardContent className="p-6 text-center">
                                <div className="text-2xl font-bold text-purple-600 mb-1">8</div>
                                <div className="text-sm text-gray-600">📅 Upcoming Events</div>
                            </CardContent>
                        </Card>
                        <Card className="border-yellow-200">
                            <CardContent className="p-6 text-center">
                                <div className="text-2xl font-bold text-yellow-600 mb-1">1,247</div>
                                <div className="text-sm text-gray-600">👥 Today's Visitors</div>
                            </CardContent>
                        </Card>
                    </div>

                    {/* Content Management Grid */}
                    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        {dashboardCards.map((card, index) => (
                            <Card key={index} className="hover:shadow-lg transition-all duration-200 hover:scale-105">
                                <CardHeader className="pb-3">
                                    <div className="flex items-center justify-between">
                                        <div className="text-3xl">{card.icon}</div>
                                        <div className="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded">
                                            CMS Module
                                        </div>
                                    </div>
                                    <CardTitle className="text-lg font-semibold">
                                        {card.title.replace(/^\S+\s/, '')} {/* Remove emoji from title */}
                                    </CardTitle>
                                    <CardDescription className="text-sm">
                                        {card.description}
                                    </CardDescription>
                                </CardHeader>
                                <CardContent className="pt-0">
                                    <div className="text-xs text-gray-600 mb-4">
                                        {card.stats}
                                    </div>
                                    <Button 
                                        className="w-full" 
                                        size="sm"
                                        onClick={() => {
                                            // Placeholder for navigation
                                            alert(`${card.action} - Feature coming soon!`);
                                        }}
                                    >
                                        {card.action}
                                    </Button>
                                </CardContent>
                            </Card>
                        ))}
                    </div>

                    {/* Recent Activity */}
                    <div className="mt-12">
                        <Card>
                            <CardHeader>
                                <CardTitle className="flex items-center gap-2">
                                    📈 Recent Activity
                                </CardTitle>
                            </CardHeader>
                            <CardContent>
                                <div className="space-y-4">
                                    <div className="flex items-center justify-between p-3 bg-blue-50 rounded-lg">
                                        <div className="flex items-center gap-3">
                                            <div className="text-blue-600">📰</div>
                                            <div>
                                                <div className="font-medium">New article published</div>
                                                <div className="text-sm text-gray-600">"Community Center Opens Downtown" by News Editor</div>
                                            </div>
                                        </div>
                                        <div className="text-xs text-gray-500">2 hours ago</div>
                                    </div>
                                    
                                    <div className="flex items-center justify-between p-3 bg-green-50 rounded-lg">
                                        <div className="flex items-center gap-3">
                                            <div className="text-green-600">🛡️</div>
                                            <div>
                                                <div className="font-medium">Service updated</div>
                                                <div className="text-sm text-gray-600">"Business License Application" requirements modified</div>
                                            </div>
                                        </div>
                                        <div className="text-xs text-gray-500">5 hours ago</div>
                                    </div>
                                    
                                    <div className="flex items-center justify-between p-3 bg-purple-50 rounded-lg">
                                        <div className="flex items-center gap-3">
                                            <div className="text-purple-600">📅</div>
                                            <div>
                                                <div className="font-medium">Event scheduled</div>
                                                <div className="text-sm text-gray-600">"Town Hall Meeting - Budget Discussion" added to calendar</div>
                                            </div>
                                        </div>
                                        <div className="text-xs text-gray-500">1 day ago</div>
                                    </div>
                                </div>
                            </CardContent>
                        </Card>
                    </div>

                    {/* Integration Placeholder */}
                    <div className="mt-8">
                        <Card className="border-dashed border-2 border-gray-300">
                            <CardContent className="p-8 text-center">
                                <div className="text-4xl mb-4">🔌</div>
                                <h3 className="text-xl font-bold text-gray-800 mb-2">
                                    System Integration Hub
                                </h3>
                                <p className="text-gray-600 mb-4">
                                    Connect with external systems, APIs, and third-party services
                                </p>
                                <Button variant="outline">
                                    Configure Integrations
                                </Button>
                            </CardContent>
                        </Card>
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}