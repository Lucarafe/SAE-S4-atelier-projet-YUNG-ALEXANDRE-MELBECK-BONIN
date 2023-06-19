class Article {
  final String id;
  final String titre;
  final String auteur;
  final DateTime createdAt;

  Article({
    required this.id,
    required this.titre,
    required this.auteur,
    required this.createdAt,
  });

  factory Article.fromJson(Map<String, dynamic> json) {
  return Article(
    id: json['id'] ?? '',
    titre: json['titre'] ?? '',
    auteur: json['auteur'] ?? '',
    createdAt: json['created_at'] != null ? DateTime.parse(json['created_at']) : DateTime.now(),
  );
}

}
