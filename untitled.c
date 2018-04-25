/*
 * Writing Your Own Shell
 *
 * CS4414 Operating Systems HW4
 * Spring 2018
 *
 * Katherine Yan
 * kjy2kh
 */


#include <stdio.h>
#include <stdint.h>
#include <string.h>
#include <unistd.h>
#include <ctype.h>
#include <sys/types.h>
#include <sys/stat.h>
#include <fcntl.h>
#include <errno.h>
#include <sys/wait.h>
#include <stdlib.h>

//global variables
char current_directory[1000];	//hold the cwd path
char input_buffer[100]; //hold the user input
char commands[100][50][50];	//hold all instructions


char* token_group[100]; //hold all of the token groups
char* args[50]; //hold the commands in each token group
int exit_codes[50]; //holds the exit codes by each exec
char a[2] = {"\n"};	
const char valid_chars[] = "-./_> <|ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
int count;
int n;
int first;
int last;

//clear all variables 
void clear() {
	input_buffer[0]='\0';
	args[0] = '\0';
	exit_codes[0] = '\0';
	token_group = 0;
	arg = 0;

	count = 0;
	n = 0;
	first = 1;
	last = 0;
}


int main() {

	//get cwd
	getcwd(current_directory, sizeof(current_directory));

	while(1) {

		//clear everything from previous line
		clear();

		//get user input
		fgets(input_buffer, 100, stdin);

		// printf("end: %c \n", input_buffer[5]);
		// printf("input: %s \n", input_buffer);

		//see if line was greater than 100 chars
		// if (input_buffer[5] != '\0') {
		// 	printf("Invalid Input");
		// 	continue;
		// }

		//if user didnt enter anything just continue to next line
		if(strcmp(input_buffer, a) == 0) {
			continue;
		}

		//see if "exit" was inputted
		int len = strlen(input_buffer);
     	input_buffer[len-1] = '\0';
		if(strcmp(input_buffer, "exit") == 0) {
			return 0;
		}

		// //see if EOF was inputted
		// if(feof(input_buffer)) {
		// 	return 0;
		// }

		//validate line for wrong characters
		int num = strspn(input_buffer, valid_chars);
		if(num + 1 != len) {
			printf("Invalid input\n");
			continue;
		}
		
		//strtok to separate first token group
		token_group[count] = strtok(input_buffer, " ");

		//fill all token groups 
		while (token_group[count] != NULL) {
			count++;
			token_group[count] = strtok(NULL, "|");
		}
		/////PROBLEM WHEN '|' IS PART OF THE WORD///////

		//set NULl to indicate end of token groups//////unnecesary???
		token_group[count] = NULL;

		//pipe setup
		int fd[count][2];

		//loop through each token group (skips if only one)
		for(int i = 0; i < count; i++) {

			//reset args for each token group
			args[0] = '\0';
			n = 0;
			int in_redirect = 0;	//if exists 
			int in_index;			//index of "<"
			int infile_fd;			//file descriptor
			char* in_redirect_file;	//file name
			int out_redirect = 0;
			int out_index;
			int outfile_fd;
			char* out_redirect_file;

			//if we are at the last token group
			if(i == (count - 1)){
				last = 1;
			}
			
			//setup pipe for this level
			pipe(fd[i]);

			//separate commands for token group
			args[n] = strtok(token_group[i], " ");
			while(args[n] != NULL) {
				// printf("token_group: %s, arg %d: %s\n", token_group[i], n, args[n]);
				// printf("first: %d, last: %d\n", first, last);
				n++;
				args[n] = strtok(NULL, " ");
			}
			args[n] = '\0';

			//loop through the commands to look for input or output redirection
			for(int j = 0; j < n; j++) {
				if (strcmp(args[j], "<") == 0) {

					in_redirect = 1;
					in_index = j;
				}
				if (strcmp(args[j], ">") == 0) {

					out_redirect = 1;
					out_index = j;
				}
			}

			//fork
			pid_t pid;
			pid = fork();

			//in the new process
			if(pid == 0) {

				//if it's the first token group 
				if(first == 1 && last != 1) {

					//if theres an output redirect, error
					if(out_redirect != 0) {
						_exit(-1);
					}

					//if theres an input redirect
					if(in_redirect != 0) {
						
						//create file
						in_redirect_file = strdup(args[in_index + 1]);
						infile_fd = open(in_redirect_file, O_RDWR | O_CREAT);

						//set up end point in args
						args[in_index] = '\0';

						//setup pipes
						dup2(fd[i][1], STDOUT_FILENO);
						dup2(infile_fd, STDIN_FILENO);
						close(fd[i][0]);
					}

					//else just setup dups
					else {
						dup2(fd[i][1], STDOUT_FILENO);
						close(fd[i][0]);
					}
				}

				//if its a middle token group
				else if(first != 1 && last != 1) {

					//if output or input redirect --> error
					if(out_redirect != 0 || in_redirect != 0) {
						_exit(-1);
					}

					//setup pipes
					dup2(fd[i-1][0], STDIN_FILENO);
					dup2(fd[i][1], STDOUT_FILENO);
					close(fd[i][0]);
					close(fd[i-1][1]);

				}

				//if last token group
				else if (first != 1 && last == 1) {

					//if theres an input redirect, error
					if(in_redirect != 0) {
						_exit(-1);
					}

					//if theres an output redirect
					if(out_redirect != 0) {
						
						//create file
						out_redirect_file = strdup(args[out_index + 1]);
						outfile_fd = open(out_redirect_file, O_RDWR | O_CREAT);

						//set up end point in args
						args[out_index] = '\0';

						//setup pipes
						dup2(outfile_fd, STDOUT_FILENO);
						dup2(fd[i-1][0], STDIN_FILENO);
						close(fd[i-1][1]);
						close(fd[i][0]);
					}

					//else just setup dups
					else {
						dup2(fd[i-1][0], STDIN_FILENO);
						close(fd[i-1][1]);
						close(fd[i][0]);
						close(fd[i][1]);
					}
					
				}

				//if only one token group
				else if(first == 1 && last == 1) {

					//if theres an input redirect
					if(in_redirect != 0) {

						//create file
						in_redirect_file = strdup(args[in_index + 1]);
						infile_fd = open(in_redirect_file, O_RDWR | O_CREAT);

						//set up end point in args
						args[in_index] = '\0';

						//setup pipes
						dup2(infile_fd, STDIN_FILENO);
					}


					//if theres an output redirect
					if(out_redirect != 0) {

						//create file
						out_redirect_file = strdup(args[out_index + 1]);
						outfile_fd = open(out_redirect_file, O_RDWR | O_CREAT);

						//set up end point in args
						args[out_index] = '\0';

						//setup pipes
						dup2(outfile_fd, STDOUT_FILENO);

					}
				}

				//exec the commands
				execvp(args[0], args);
			}

			//parent process
			else {

				//wait for command
				int status;
				waitpid(pid, &status, WUNTRACED);

				//get exit status and put into the error codes array
				if(WIFEXITED(status)) {
					exit_codes[i] = status;
				}
			}

			//set to 0 after first iteration
			first = 0;

		}

		//print exit codes once all token groups have been executed
		for(int k = 0; k < count; k++) {

			//if an error was encountered
			if(exit_codes[k] != 0) {
				fprintf(stderr, "Command %s failed to execute\n”", token_group[k]);
				break;
			}

			//else just print the codes
			fprintf(stderr, "%d\n", exit_codes[k]);

		}

	}

	return 0;

}









