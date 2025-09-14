import React from 'react';
import { Head, Link } from '@inertiajs/react';
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

interface PaginatedNews {
    data: NewsItem[];
    current_page: number;
    last_page: number;
    per_page: number;
    total: number;
    links: Array<{
        url: string | null;
        label: string;
        active: boolean;
    }>;
}

interface Props {
    news: PaginatedNews;
    [key: string]: unknown;
}

export default function NewsIndex({ news }: Props) {
    const formatDate = (dateString: string) => {
        return new Date(dateString).toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
    };

    return (
        <>
            <Head title="Latest News" />
            
            <div className="min-h-screen bg-gradient-to-b from-blue-50 to-white">
                {/* Header */}
                <div className="bg-gradient-to-r from-blue-600 to-blue-800 text-white">
                    <div className="container mx-auto px-4 py-16">
                        <div className="text-center">
                            <h1 className="text-4xl font-bold mb-4">📰 Latest News</h1>
                            <p className="text-xl text-blue-100">
                                Stay informed with the latest updates from Regional Government
                            </p>
                        </div>
                    </div>
                </div>

                {/* Navigation */}
                <div className="bg-white border-b">
                    <div className="container mx-auto px-4 py-4">
                        <nav className="flex items-center space-x-2 text-sm text-gray-600">
                            <Link href="/" className="hover:text-blue-600">🏠 Home</Link>
                            <span>/</span>
                            <span className="text-gray-900">News</span>
                        </nav>
                    </div>
                </div>

                {/* Content */}
                <div className="container mx-auto px-4 py-12">
                    {/* Stats */}
                    <div className="mb-8">
                        <p className="text-gray-600">
                            Showing {news.data.length} of {news.total} articles 
                            (Page {news.current_page} of {news.last_page})
                        </p>
                    </div>

                    {/* News Grid */}
                    <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                        {news.data.map((article) => (
                            <Card key={article.id} className="hover:shadow-lg transition-shadow border-blue-100">
                                <CardHeader>
                                    <CardTitle className="text-lg line-clamp-2">
                                        {article.title}
                                    </CardTitle>
                                    <CardDescription className="flex flex-wrap items-center gap-2">
                                        <span>By {article.author.name}</span>
                                        {article.department && (
                                            <Badge variant="secondary" className="text-xs">
                                                {article.department.name}
                                            </Badge>
                                        )}
                                    </CardDescription>
                                </CardHeader>
                                <CardContent>
                                    <p className="text-gray-600 mb-4 line-clamp-3">
                                        {article.excerpt}
                                    </p>
                                    <div className="flex justify-between items-center text-sm text-gray-500">
                                        <span>📅 {formatDate(article.published_at)}</span>
                                        <span>👁️ {article.views_count} views</span>
                                    </div>
                                </CardContent>
                                <CardFooter>
                                    <Button variant="outline" className="w-full">
                                        <Link href={`/news/${article.slug}`}>
                                            Read Full Article
                                        </Link>
                                    </Button>
                                </CardFooter>
                            </Card>
                        ))}
                    </div>

                    {/* Pagination */}
                    {news.last_page > 1 && (
                        <div className="flex justify-center space-x-2">
                            {news.links.map((link, index) => (
                                <div key={index}>
                                    {link.url ? (
                                        <Link
                                            href={link.url}
                                            className={`px-4 py-2 rounded border ${
                                                link.active
                                                    ? 'bg-blue-600 text-white border-blue-600'
                                                    : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50'
                                            }`}
                                            dangerouslySetInnerHTML={{ __html: link.label }}
                                        />
                                    ) : (
                                        <span
                                            className="px-4 py-2 rounded border bg-gray-100 text-gray-400 border-gray-300"
                                            dangerouslySetInnerHTML={{ __html: link.label }}
                                        />
                                    )}
                                </div>
                            ))}
                        </div>
                    )}

                    {/* No articles message */}
                    {news.data.length === 0 && (
                        <div className="text-center py-16">
                            <div className="text-6xl mb-4">📰</div>
                            <h3 className="text-2xl font-bold text-gray-800 mb-2">
                                No news articles found
                            </h3>
                            <p className="text-gray-600 mb-6">
                                Check back later for the latest updates from Regional Government.
                            </p>
                            <Button>
                                <Link href="/">Return Home</Link>
                            </Button>
                        </div>
                    )}
                </div>

                {/* Back to Home */}
                <div className="bg-gray-50 border-t">
                    <div className="container mx-auto px-4 py-8 text-center">
                        <Button size="lg">
                            <Link href="/">🏠 Back to Home</Link>
                        </Button>
                    </div>
                </div>
            </div>
        </>
    );
}