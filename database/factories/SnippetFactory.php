<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SnippetFactory extends Factory
{
    public function definition(): array
    {
        $frameworks = [
            ['language' => 'JavaScript', 'framework' => 'React', 'code' => "const App = () => {\n  const [count, setCount] = useState(0);\n  \n  return (\n    <div>\n      <p>Count: {count}</p>\n      <button onClick={() => setCount(count + 1)}>Increment</button>\n    </div>\n  );\n};"],
            
            ['language' => 'JavaScript', 'framework' => 'Vue.js', 'code' => "<template>\n  <div>\n    <p>{{ message }}</p>\n    <button @click=\"reverseMessage\">Reverse</button>\n  </div>\n</template>\n\n<script>\nexport default {\n  data() {\n    return { message: 'Hello Vue!' }\n  },\n  methods: {\n    reverseMessage() {\n      this.message = this.message.split('').reverse().join('')\n    }\n  }\n}\n</script>"],
            
            ['language' => 'PHP', 'framework' => 'Laravel', 'code' => "Route::get('/users', function () {\n    return User::with('posts')\n        ->where('active', true)\n        ->paginate(15);\n});\n\nRoute::post('/users', [UserController::class, 'store'])\n    ->middleware('auth');"],
            
            ['language' => 'Python', 'framework' => 'Django', 'code' => "from django.db import models\n\nclass Article(models.Model):\n    title = models.CharField(max_length=200)\n    content = models.TextField()\n    published_date = models.DateTimeField(auto_now_add=True)\n    author = models.ForeignKey(User, on_delete=models.CASCADE)\n    \n    class Meta:\n        ordering = ['-published_date']\n    \n    def __str__(self):\n        return self.title"],
            
            ['language' => 'TypeScript', 'framework' => 'Angular', 'code' => "@Component({\n  selector: 'app-user-list',\n  template: `\n    <div *ngFor=\"let user of users\">\n      <h3>{{ user.name }}</h3>\n      <p>{{ user.email }}</p>\n    </div>\n  `\n})\nexport class UserListComponent implements OnInit {\n  users: User[] = [];\n  \n  constructor(private userService: UserService) {}\n  \n  ngOnInit() {\n    this.userService.getUsers().subscribe(data => {\n      this.users = data;\n    });\n  }\n}"],
        ];

        $random = $this->faker->randomElement($frameworks);

        return [
            'code' => $random['code'],
            'language' => $random['language'],
            'framework' => $random['framework'],
            'difficulty' => $this->faker->randomElement(['easy', 'medium', 'hard']),
        ];
    }

    public function easy()
    {
        return $this->state(fn (array $attributes) => [
            'difficulty' => 'easy',
        ]);
    }

    public function medium()
    {
        return $this->state(fn (array $attributes) => [
            'difficulty' => 'medium',
        ]);
    }

    public function hard()
    {
        return $this->state(fn (array $attributes) => [
            'difficulty' => 'hard',
        ]);
    }
}