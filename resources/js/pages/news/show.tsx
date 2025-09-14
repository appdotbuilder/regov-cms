import React from 'react';
import { Head, Link } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Badge } from '@/components/ui/badge';

interface NewsArticle {
    id: number;
    title: string;
    slug: string;
    excerpt: string;
    content: string;
    published_at: string;
    author: {
        name: string;
    };
    department?: {
        name: string;
    };
    views_count: number;
    featured_image?: string;
}

interface Props {
    article: NewsArticle;
    [key: string]: unknown;
}

export default function NewsShow({ article }: Props) {
    const formatDate = (dateString: string) => {
        return new Date(dateString).toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        });
    };

    return (
        <>
            <Head title={article.title} />
            
            <div className="min-h-screen bg-gradient-to-b from-blue-50 to-white">
                {/* Navigation */}
                <div className="bg-white border-b">
                    <div className="container mx-auto px-4 py-4">
                        <nav className="flex items-center space-x-2 text-sm text-gray-600">
                            <Link href="/" className="hover:text-blue-600">🏠 Home</Link>
                            <span>/</span>
                            <Link href="/news" className="hover:text-blue-600">📰 News</Link>
                            <span>/</span>
                            <span className="text-gray-900">{article.title}</span>
                        </nav>
                    </div>
                </div>

                {/* Article Content */}
                <div className="container mx-auto px-4 py-12">
                    <div className="max-w-4xl mx-auto">
                        {/* Article Header */}
                        <div className="mb-8">
                            <h1 className="text-4xl font-bold text-gray-900 mb-6">
                                {article.title}
                            </h1>

                            <div className="flex flex-wrap items-center gap-4 text-gray-600 mb-6">
                                <div className="flex items-center space-x-2">
                                    <span>✍️</span>
                                    <span>By {article.author.name}</span>
                                </div>
                                
                                <div className="flex items-center space-x-2">
                                    <span>📅</span>
                                    <span>{formatDate(article.published_at)}</span>
                                </div>
                                
                                <div className="flex items-center space-x-2">
                                    <span>👁️</span>
                                    <span>{article.views_count} views</span>
                                </div>

                                {article.department && (
                                    <Badge className="bg-blue-600">
                                        🏢 {article.department.name}
                                    </Badge>
                                )}
                            </div>

                            {/* Featured Image */}
                            {article.featured_image && (
                                <div className="mb-8">
                                    <img 
                                        src={article.featured_image} 
                                        alt={article.title}
                                        className="w-full h-64 object-cover rounded-lg shadow-lg"
                                    />
                                </div>
                            )}

                            {/* Excerpt */}
                            <div className="bg-blue-50 border-l-4 border-blue-500 p-6 mb-8">
                                <p className="text-lg text-gray-700 leading-relaxed">
                                    {article.excerpt}
                                </p>
                            </div>
                        </div>

                        {/* Article Body */}
                        <div className="prose prose-lg max-w-none mb-12">
                            <div 
                                className="text-gray-700 leading-relaxed"
                                style={{ whiteSpace: 'pre-wrap' }}
                            >
                                {article.content}
                            </div>
                        </div>

                        {/* Share & Navigation */}
                        <div className="border-t pt-8">
                            <div className="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                                <div className="flex flex-wrap gap-4">
                                    <Button variant="outline">
                                        <Link href="/news">📰 More News</Link>
                                    </Button>
                                    <Button variant="outline">
                                        <Link href="/">🏠 Home</Link>
                                    </Button>
                                    {article.department && (
                                        <Button variant="outline">
                                            <Link href={`/departments/${article.department.name.toLowerCase().replace(/\s+/g, '-')}`}>
                                                🏢 {article.department.name}
                                            </Link>
                                        </Button>
                                    )}
                                </div>

                                <div className="flex gap-2">
                                    <Button 
                                        variant="outline" 
                                        size="sm"
                                        onClick={() => navigator.share?.({
                                            title: article.title,
                                            text: article.excerpt,
                                            url: window.location.href
                                        }) || navigator.clipboard.writeText(window.location.href)}
                                    >
                                        📤 Share
                                    </Button>
                                    <Button 
                                        variant="outline" 
                                        size="sm"
                                        onClick={() => window.print()}
                                    >
                                        🖨️ Print
                                    </Button>
                                </div>
                            </div>
                        </div>

                        {/* Contact Information */}
                        {article.department && (
                            <div className="bg-gray-50 rounded-lg p-6 mt-8">
                                <h3 className="text-xl font-bold text-gray-900 mb-4">
                                    📞 Contact Information
                                </h3>
                                <p className="text-gray-700">
                                    For more information about this news article or related services, 
                                    please contact <strong>{article.department.name}</strong>.
                                </p>
                                <div className="mt-4 flex gap-4">
                                    <Button variant="outline">
                                        <Link href={`/departments/${article.department.name.toLowerCase().replace(/\s+/g, '-')}`}>
                                            View Department
                                        </Link>
                                    </Button>
                                    <Button variant="outline">
                                        <Link href="/contact">Contact Us</Link>
                                    </Button>
                                </div>
                            </div>
                        )}
                    </div>
                </div>

                {/* Related Links */}
                <div className="bg-blue-600 text-white">
                    <div className="container mx-auto px-4 py-12">
                        <div className="text-center">
                            <h2 className="text-2xl font-bold mb-6">Stay Connected</h2>
                            <div className="flex flex-wrap justify-center gap-4">
                                <Button size="lg" className="bg-yellow-500 hover:bg-yellow-600 text-black">
                                    <Link href="/news">📰 More News</Link>
                                </Button>
                                <Button size="lg" variant="outline" className="text-white border-white hover:bg-white hover:text-blue-800">
                                    <Link href="/services">🛡️ Public Services</Link>
                                </Button>
                                <Button size="lg" variant="outline" className="text-white border-white hover:bg-white hover:text-blue-800">
                                    <Link href="/events">📅 Events</Link>
                                </Button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </>
    );
}