<x-layout>
  @auth
      <h1>welcome logged in</h1>
  @endauth

  @guest
      <h1>Welcome Guest</h1>
  @endguest
</x-layout>
