import 'dart:convert';

import 'package:flutter/material.dart';

import '../models/article.dart';
import '../models/categorie.dart';
import '../providers/api_provider.dart';

class HomePage extends StatefulWidget {
  const HomePage({super.key});

  @override
  _HomePageState createState() => _HomePageState();
}

class _HomePageState extends State<HomePage> {
  List<Article> articles = [];
  List<Categorie> categories = [];

  @override
  void initState() {
    super.initState();
    fetchData();
  }

  void fetchData() async {
    await fetchArticles();
    await fetchCategories();
  }

  Future<void> fetchArticles() async {
  final response = await ApiProvider.get('/api/articles?date-desc');
  if (response.statusCode == 200) {
    final Map<String, dynamic> data = json.decode(response.body);
    final List<dynamic> articlesJson = data['articles'];

    setState(() {
      articles = articlesJson
          .map((json) => Article.fromJson(json['article']))
          .toList();
    });
  } else {
    throw Exception('Failed to fetch articles');
  }
}


  Future<void> fetchCategories() async {
  final response = await ApiProvider.get('/api/categories');

  if (response.statusCode == 200) {
    final Map<String, dynamic> data = json.decode(response.body);
    final List<dynamic> categoriesJson = data['categories'];

    setState(() {
      categories = categoriesJson
          .map((json) => Categorie.fromJson(json))
          .toList();
    });
  } else {
    throw Exception('Failed to fetch categories');
  }
}


  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('MiniPress'),
      ),
      body: Column(
        children: [
          Expanded(
            child: ListView.builder(
              itemCount: articles.length,
              itemBuilder: (context, index) {
                final article = articles[index];
                return ListTile(
                  title: Text(article.titre),
                  subtitle: Text('Auteur: ${article.auteur} | Créé le: ${article.createdAt.year}-${article.createdAt.month}-${article.createdAt.day}'),
                  onTap: () {
                    Navigator.push(
                      context,
                      MaterialPageRoute(
                        builder: (context) => ArticlePage(article: article),
                      ),
                    );
                  },
                );
              },
            ),
          ),
        ],
      ),
    );
  }
}

class ArticlePage extends StatelessWidget {
  final Article article;

  ArticlePage({required this.article});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text(article.titre),
      ),
      body: Padding(
        padding: const EdgeInsets.all(8.0),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Text('Auteur: ${article.auteur}'),
            SizedBox(height: 16),
            Text('Créé le: ${article.createdAt.toString()}'),
            SizedBox(height: 16),
            // Add the article content here
          ],
        ),
      ),
    );
  }
}
