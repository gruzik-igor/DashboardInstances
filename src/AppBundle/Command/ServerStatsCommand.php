<?php 

namespace AppBundle\Command;

class ServerStatsCommand extends EndlessCommand

{
	// This is just a normal Command::configure() method
	protected function configure()
	{
		$this->setName('app:server:info')
			 ->setDescription('An EndlessCommand implementation example');
	}

	// Execute will be called in a endless loop
	protected function execute(InputInterface $input, OutputInterface $output)
	{
		// Tell the user what we're going to do.
		// This will be a NullOutput if the user doesn't want any output at all,
		//  so you don't have to do any checks, just always write to the output.
		$output->write('Updating timestamp... ');

		// Do some work
		file_put_contents( '/tmp/acme-timestamp.txt', time() );

		// Tell the user we're done
		$output->writeln('done');
    }
    
}