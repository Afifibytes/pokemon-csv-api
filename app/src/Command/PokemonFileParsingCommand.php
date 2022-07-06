<?php

namespace App\Command;

use App\Entity\Pokemon;
use App\Repository\PokemonRepository;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:pokemon:file-parsing',
    description: 'Parsing pokemon csv file filling the DB',
)]
class PokemonFileParsingCommand extends Command
{
    const POKEMON_FILE_PATH = './../../../mnt/pokemons/pokemon.csv';

    private PokemonRepository $pokemonRepository;

    public function __construct(
        string $name = null,
        PokemonRepository $pokemonRepository
    ){
        $this->pokemonRepository = $pokemonRepository;
        parent::__construct($name);
    }

    protected function configure(): void
    {
        $this
            ->addOption(
                'dry-test',
                'dt',
                InputOption::VALUE_NONE,
                'Option for running the command without touching the DB'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $this->pokemonFileParsing();
        $io->success('Now all Pokemons are being parsed!');

        return Command::SUCCESS;
    }

    private function pokemonFileParsing()
    {
        if (($file = fopen(self::POKEMON_FILE_PATH, "r")) !== false) {
            while (($rowData = fgetcsv($file)) !== false) {
                $pokemon = self::pokemonHydrate($rowData);

                if ($pokemon->isLegendary() || $pokemon->isGhost()) {
                    continue;
                }
                $pokemon = $this->applyPokemonConditions($pokemon);
                $this->pokemonRepository->add($pokemon, true);
            }
        }
    }

    /**
     * @param Pokemon $pokemon
     * @return Pokemon
     */
    private function applyPokemonConditions(Pokemon $pokemon): Pokemon
    {
        if ($pokemon->isSteel()) {
            $this->doublePokemonHP($pokemon);
        }
        if ($pokemon->isBug() || $pokemon->isFlying()) {
            $this->increasePokemonAttack($pokemon);
        }
        if (preg_match('/^[Gg]/', $pokemon->getName()))
        {
            $this->increasePokemonDefenceBasedOnNameLetters($pokemon);
        }

        return $pokemon;
    }

    /**
     * @param Pokemon $pokemon
     * @return void
     */
    private function doublePokemonHP(Pokemon $pokemon)
    {
        $pokemon->setHP($pokemon->getHP() * 2);
    }

    /**
     * @param Pokemon $pokemon
     * @return void
     */
    private function increasePokemonAttack(Pokemon $pokemon, $percent = 10)
    {
        $attackSpeedIncrease = ($pokemon->getSpAtk() * $percent) / 100;
        $pokemon->setSpAtk($pokemon->getSpAtk() + $attackSpeedIncrease);
    }

    /**
     * @param Pokemon $pokemon
     * @param int $letterWeight
     * @param bool $excludeFirstLetter
     * @return void
     */
    private function increasePokemonDefenceBasedOnNameLetters(Pokemon $pokemon, int $letterWeight = 5, $excludeFirstLetter = true)
    {
        if ($excludeFirstLetter) {
            $defenseBoosterValue = (strlen($pokemon->getName()) - 1) * $letterWeight;
        } else {
            $defenseBoosterValue = (strlen($pokemon->getName())) * $letterWeight;
        }

        $pokemon->setDefense($pokemon->getDefense() + $defenseBoosterValue);
    }

    /**
     * @param array $rowData
     * @return Pokemon
     */
    private static function pokemonHydrate(array $rowData): Pokemon
    {
        $pokemon = new Pokemon();
        $pokemon->setSerial((int)$rowData[0]);
        $pokemon->setName($rowData[1]);
        $pokemon->setType1($rowData[2]);
        $pokemon->setType2($rowData[3]);
        $pokemon->setTotal((int)$rowData[4]);
        $pokemon->setHP((int)$rowData[5]);
        $pokemon->setAttack((int)$rowData[6]);
        $pokemon->setDefense((int)$rowData[7]);
        $pokemon->setSpAtk((int)$rowData[8]);
        $pokemon->setSpDef((int)$rowData[9]);
        $pokemon->setSpeed((int)$rowData[10]);
        $pokemon->setGeneration((int)$rowData[11]);
        if ($rowData[12] === "True") {
            $pokemon->setLegendary(true);
        } else {
            $pokemon->setLegendary(false);
        }


        return $pokemon;
    }
}
