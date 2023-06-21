class Article {
  final String id;
  final String titre;
  final String resume;
  final String contenu;
  final String auteur;
  final DateTime createdAt;
  final String href;
  final String hrefAuteur;

  Article({
    required this.id,
    required this.titre,
    required this.resume,
    required this.contenu,
    required this.auteur,
    required this.createdAt,
    required this.href,
    required this.hrefAuteur,
  });

  factory Article.fromJson(Map<String, dynamic> json) {
    return Article(
      id: json['article']['id'].toString(),
      titre: json['article']['titre'].toString(),
      resume: json['article']['resume'].toString(),
      contenu: json['article']['contenu'].toString(),
      auteur: json['article']['auteur'].toString(),
      href: json['links']['self']['href'] ?? '',
      hrefAuteur: json['href'] ?? '',
      createdAt: json['created_at'] != null ? DateTime.parse(json['created_at']) : DateTime.now(),
    );
  }
}
