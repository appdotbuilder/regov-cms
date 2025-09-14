import React from 'react';
import { Link } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';

interface NewsItem {
    id: number;
    title: string;
    slug: string;
    excerpt: string;
    published_at: string;
    author: {
        name: string;
    };
    department?: {
        name: string;
    };
    views_count: number;
}

interface Announcement {
    id: number;
    title: string;
    content: string;
    priority: 'low' | 'medium' | 'high' | 'urgent';
    published_at: string;
}

interface Event {
    id: number;
    title: string;
    slug: string;
    start_date: string;
    location?: string;
    department?: {
        name: string;
    };
    is_featured: boolean;
}



interface Department {
    id: number;
    name: string;
    slug: string;
    description?: string;
}

interface Stats {
    news_count: number;
    services_count: number;
    departments_count: number;
    upcoming_events: number;
}

interface Props {
    latestNews: NewsItem[];
    urgentAnnouncements: Announcement[];
    upcomingEvents: Event[];
    departments: Department[];
    stats: Stats;
    [key: string]: unknown;
}

export default function Welcome({
    latestNews,
    urgentAnnouncements,
    upcomingEvents,
    departments,
    stats
}: Props) {
    const formatDate = (dateString: string) => {
        return new Date(dateString).toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
    };



    return (
        <div className="min-h-screen bg-gradient-to-b from-blue-50 to-yellow-50">
            {/* Hero Section */}
            <div className="bg-gradient-to-r from-blue-600 to-blue-800 text-white">
                <div className="container mx-auto px-4 py-16">
                    <div className="text-center">
                        <h1 className="text-5xl font-bold mb-4">
                            🏛️ Regional Government Portal
                        </h1>
                        <p className="text-xl mb-8 text-blue-100">
                            Your gateway to government services, news, and information
                        </p>
                        <div className="flex flex-wrap justify-center gap-4">
                            <Button size="lg" className="bg-yellow-500 hover:bg-yellow-600 text-black">
                                <Link href="/services">🛡️ Public Services</Link>
                            </Button>
                            <Button size="lg" variant="outline" className="text-white border-white hover:bg-white hover:text-blue-800">
                                <Link href="/news">📰 Latest News</Link>
                            </Button>
                            <Button size="lg" variant="outline" className="text-white border-white hover:bg-white hover:text-blue-800">
                                <Link href="/login">🔐 Staff Login</Link>
                            </Button>
                        </div>
                    </div>
                </div>
            </div>

            {/* Stats Section */}
            <div className="container mx-auto px-4 py-12">
                <div className="grid grid-cols-2 md:grid-cols-4 gap-6 mb-16">
                    <Card className="text-center border-blue-200">
                        <CardContent className="p-6">
                            <div className="text-3xl font-bold text-blue-600 mb-2">
                                {stats.news_count}
                            </div>
                            <div className="text-gray-600">📰 News Articles</div>
                        </CardContent>
                    </Card>
                    <Card className="text-center border-yellow-200">
                        <CardContent className="p-6">
                            <div className="text-3xl font-bold text-yellow-600 mb-2">
                                {stats.services_count}
                            </div>
                            <div className="text-gray-600">🛡️ Public Services</div>
                        </CardContent>
                    </Card>
                    <Card className="text-center border-green-200">
                        <CardContent className="p-6">
                            <div className="text-3xl font-bold text-green-600 mb-2">
                                {stats.departments_count}
                            </div>
                            <div className="text-gray-600">🏢 Departments</div>
                        </CardContent>
                    </Card>
                    <Card className="text-center border-purple-200">
                        <CardContent className="p-6">
                            <div className="text-3xl font-bold text-purple-600 mb-2">
                                {stats.upcoming_events}
                            </div>
                            <div className="text-gray-600">📅 Upcoming Events</div>
                        </CardContent>
                    </Card>
                </div>

                {/* Urgent Announcements */}
                {urgentAnnouncements.length > 0 && (
                    <div className="mb-16">
                        <div className="bg-red-600 text-white p-4 rounded-lg mb-6">
                            <h2 className="text-2xl font-bold mb-4">🚨 Urgent Announcements</h2>
                            <div className="space-y-4">
                                {urgentAnnouncements.map((announcement) => (
                                    <div key={announcement.id} className="bg-red-700 p-4 rounded">
                                        <h3 className="font-bold text-lg mb-2">{announcement.title}</h3>
                                        <p className="text-red-100">{announcement.content}</p>
                                        <p className="text-sm text-red-200 mt-2">
                                            Published: {formatDate(announcement.published_at)}
                                        </p>
                                    </div>
                                ))}
                            </div>
                        </div>
                    </div>
                )}

                {/* Latest News */}
                <section className="mb-16">
                    <div className="flex justify-between items-center mb-8">
                        <h2 className="text-3xl font-bold text-blue-800">📰 Latest News</h2>
                        <Button variant="outline" className="border-blue-600 text-blue-600">
                            <Link href="/news">View All News</Link>
                        </Button>
                    </div>
                    <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                        {latestNews.map((article) => (
                            <Card key={article.id} className="hover:shadow-lg transition-shadow border-blue-100">
                                <CardHeader>
                                    <CardTitle className="text-lg">{article.title}</CardTitle>
                                    <CardDescription className="flex items-center gap-2">
                                        <span>By {article.author.name}</span>
                                        {article.department && (
                                            <Badge variant="secondary">{article.department.name}</Badge>
                                        )}
                                    </CardDescription>
                                </CardHeader>
                                <CardContent>
                                    <p className="text-gray-600 mb-4">{article.excerpt}</p>
                                    <div className="flex justify-between items-center text-sm text-gray-500">
                                        <span>{formatDate(article.published_at)}</span>
                                        <span>{article.views_count} views</span>
                                    </div>
                                </CardContent>
                                <CardFooter>
                                    <Button variant="outline" className="w-full">
                                        <Link href={`/news/${article.slug}`}>Read More</Link>
                                    </Button>
                                </CardFooter>
                            </Card>
                        ))}
                    </div>
                </section>

                {/* Upcoming Events */}
                {upcomingEvents.length > 0 && (
                    <section className="mb-16">
                        <div className="flex justify-between items-center mb-8">
                            <h2 className="text-3xl font-bold text-purple-800">📅 Upcoming Events</h2>
                            <Button variant="outline" className="border-purple-600 text-purple-600">
                                <Link href="/events">View All Events</Link>
                            </Button>
                        </div>
                        <div className="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                            {upcomingEvents.map((event) => (
                                <Card key={event.id} className="border-purple-100">
                                    <CardHeader>
                                        <div className="flex items-start justify-between">
                                            <CardTitle className="text-base">{event.title}</CardTitle>
                                            {event.is_featured && (
                                                <Badge className="bg-purple-600">Featured</Badge>
                                            )}
                                        </div>
                                    </CardHeader>
                                    <CardContent className="space-y-2">
                                        <p className="text-sm text-gray-600">
                                            📅 {formatDate(event.start_date)}
                                        </p>
                                        {event.location && (
                                            <p className="text-sm text-gray-600">
                                                📍 {event.location}
                                            </p>
                                        )}
                                        {event.department && (
                                            <Badge variant="secondary" className="text-xs">
                                                {event.department.name}
                                            </Badge>
                                        )}
                                    </CardContent>
                                    <CardFooter>
                                        <Button variant="outline" size="sm" className="w-full">
                                            <Link href={`/events/${event.slug}`}>View Details</Link>
                                        </Button>
                                    </CardFooter>
                                </Card>
                            ))}
                        </div>
                    </section>
                )}

                {/* Departments */}
                <section className="mb-16">
                    <div className="flex justify-between items-center mb-8">
                        <h2 className="text-3xl font-bold text-green-800">🏢 Government Departments</h2>
                        <Button variant="outline" className="border-green-600 text-green-600">
                            <Link href="/departments">View All Departments</Link>
                        </Button>
                    </div>
                    <div className="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        {departments.slice(0, 8).map((department) => (
                            <Card key={department.id} className="hover:shadow-md transition-shadow border-green-100">
                                <CardHeader>
                                    <CardTitle className="text-base text-center">{department.name}</CardTitle>
                                </CardHeader>
                                <CardContent>
                                    <p className="text-sm text-gray-600 text-center mb-4">
                                        {department.description ? 
                                            department.description.substring(0, 100) + '...' : 
                                            'Government department providing public services'
                                        }
                                    </p>
                                </CardContent>
                                <CardFooter>
                                    <Button variant="outline" size="sm" className="w-full">
                                        <Link href={`/departments/${department.slug}`}>Learn More</Link>
                                    </Button>
                                </CardFooter>
                            </Card>
                        ))}
                    </div>
                </section>

                {/* Quick Access */}
                <section className="bg-gradient-to-r from-yellow-100 to-blue-100 p-8 rounded-lg">
                    <h2 className="text-3xl font-bold text-center mb-8 text-gray-800">🚀 Quick Access</h2>
                    <div className="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <Card className="text-center hover:shadow-lg transition-shadow">
                            <CardContent className="p-6">
                                <div className="text-4xl mb-4">🛡️</div>
                                <h3 className="font-bold mb-2">Public Services</h3>
                                <p className="text-sm text-gray-600 mb-4">
                                    Access government services and applications
                                </p>
                                <Button className="w-full">
                                    <Link href="/services">Browse Services</Link>
                                </Button>
                            </CardContent>
                        </Card>

                        <Card className="text-center hover:shadow-lg transition-shadow">
                            <CardContent className="p-6">
                                <div className="text-4xl mb-4">📄</div>
                                <h3 className="font-bold mb-2">Documents</h3>
                                <p className="text-sm text-gray-600 mb-4">
                                    Download forms, policies, and reports
                                </p>
                                <Button className="w-full">
                                    <Link href="/documents">View Documents</Link>
                                </Button>
                            </CardContent>
                        </Card>

                        <Card className="text-center hover:shadow-lg transition-shadow">
                            <CardContent className="p-6">
                                <div className="text-4xl mb-4">📸</div>
                                <h3 className="font-bold mb-2">Gallery</h3>
                                <p className="text-sm text-gray-600 mb-4">
                                    Photos and videos from events and activities
                                </p>
                                <Button className="w-full">
                                    <Link href="/gallery">View Gallery</Link>
                                </Button>
                            </CardContent>
                        </Card>

                        <Card className="text-center hover:shadow-lg transition-shadow">
                            <CardContent className="p-6">
                                <div className="text-4xl mb-4">📧</div>
                                <h3 className="font-bold mb-2">Contact</h3>
                                <p className="text-sm text-gray-600 mb-4">
                                    Get in touch with government offices
                                </p>
                                <Button className="w-full">
                                    <Link href="/contact">Contact Us</Link>
                                </Button>
                            </CardContent>
                        </Card>
                    </div>
                </section>
            </div>

            {/* Footer */}
            <footer className="bg-blue-800 text-white py-12">
                <div className="container mx-auto px-4">
                    <div className="grid md:grid-cols-4 gap-8">
                        <div>
                            <h3 className="text-xl font-bold mb-4">🏛️ Regional Government</h3>
                            <p className="text-blue-200">
                                Serving our community with transparency, efficiency, and dedication.
                            </p>
                        </div>
                        <div>
                            <h4 className="font-bold mb-4">Quick Links</h4>
                            <ul className="space-y-2 text-blue-200">
                                <li><Link href="/services" className="hover:text-white">Services</Link></li>
                                <li><Link href="/departments" className="hover:text-white">Departments</Link></li>
                                <li><Link href="/news" className="hover:text-white">News</Link></li>
                                <li><Link href="/events" className="hover:text-white">Events</Link></li>
                            </ul>
                        </div>
                        <div>
                            <h4 className="font-bold mb-4">Resources</h4>
                            <ul className="space-y-2 text-blue-200">
                                <li><Link href="/documents" className="hover:text-white">Documents</Link></li>
                                <li><Link href="/gallery" className="hover:text-white">Gallery</Link></li>
                                <li><Link href="/forms" className="hover:text-white">Online Forms</Link></li>
                                <li><Link href="/contact" className="hover:text-white">Contact</Link></li>
                            </ul>
                        </div>
                        <div>
                            <h4 className="font-bold mb-4">Staff Portal</h4>
                            <ul className="space-y-2 text-blue-200">
                                <li><Link href="/login" className="hover:text-white">Login</Link></li>
                                <li><Link href="/register" className="hover:text-white">Register</Link></li>
                                <li><Link href="/dashboard" className="hover:text-white">Dashboard</Link></li>
                            </ul>
                        </div>
                    </div>
                    <div className="border-t border-blue-700 mt-8 pt-8 text-center text-blue-200">
                        <p>&copy; 2024 Regional Government Portal. All rights reserved.</p>
                    </div>
                </div>
            </footer>
        </div>
    );
}